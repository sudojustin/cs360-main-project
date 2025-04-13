<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserProduct;
use App\Models\Equivalence;
use App\Models\User;

class OfferController extends Controller
{
    // Show the offers page with all available products
    public function index()
    {
        // Get all predefined products
        $allProducts = Product::all();
        
        // Get the current user's inventory (products they have quantities of)
        $userInventory = UserProduct::with('product')
            ->where('user_id', auth()->id())
            ->where('quantity', '>', 0)
            ->get();
            
        // Get products that other users have in their inventory
        $otherUserProducts = UserProduct::with(['product', 'user'])
            ->where('user_id', '!=', auth()->id())
            ->where('quantity', '>', 0)
            ->get();
        
        // Get pending transaction offers - both initiated by and sent to the current user
        $pendingTrades = Transaction::with(['initiator', 'counterparty', 'partnerB', 'partnerY', 'productp', 'producte'])
            ->where(function($query) {
                $query->where('counterparty_id', auth()->id())
                      ->orWhere('initiator_id', auth()->id())
                      ->orWhere('partner_b_id', auth()->id())
                      ->orWhere('partner_y_id', auth()->id());
            })
            ->whereIn('status', ['Pending', 'Countered'])
            ->get();
        
        // Transform the data to include counterparty user info
        $pendingTrades = $pendingTrades->map(function ($trade) {
            $trade->requestedProduct = $trade->productp;
            $trade->quantity_requested = $trade->quantity_p;
            $trade->offeredProduct = $trade->producte;
            $trade->quantity_offered = $trade->quantity_e;
            
            // Add receiver information
            if (!isset($trade->receiver) && isset($trade->counterparty_id)) {
                $trade->receiver = User::find($trade->counterparty_id);
            }
            
            return $trade;
        });
        
        // Get user's products for ownership checking
        $userProductIds = UserProduct::where('user_id', auth()->id())
            ->where('quantity', '>', 0)
            ->pluck('product_id')
            ->toArray();
        
        // Get all users for partner selection
        $users = User::where('id', '!=', auth()->id())->get();
        
        // Get partner's products if partner exists
        $partnerProducts = collect([]);
        if (auth()->user()->partner_id) {
            $partnerProducts = UserProduct::with('product')
                ->where('user_id', auth()->user()->partner_id)
                ->where('quantity', '>', 0)
                ->get();
        }
        
        return view('offers', compact(
            'allProducts', 
            'userInventory', 
            'otherUserProducts', 
            'pendingTrades',
            'userProductIds',
            'users',
            'partnerProducts'
        ));
    }

    // Get products available from a specific user (for partner selection)
    public function getPartnerProducts(User $user)
    {
        // Ensure the requested user is not the current user
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'Cannot select yourself as partner'], 400);
        }
        
        // Get partner's inventory with available products
        $partnerInventory = UserProduct::with('product')
            ->where('user_id', $user->id)
            ->where('quantity', '>', 0)
            ->get();
            
        return response()->json($partnerInventory);
    }

    // Calculate equivalent product amount based on equivalence table
    public function calculateEquivalent(Request $request)
    {
        $request->validate([
            'product_p_id' => 'required|exists:products,id',
            'product_e_id' => 'required|exists:products,id',
            'quantity_p' => 'required|integer|min:1',
        ]);
        
        $productP = Product::findOrFail($request->product_p_id);
        $productE = Product::findOrFail($request->product_e_id);
        $quantityP = $request->quantity_p;
        
        // Look for a specific equivalence entry for these products
        $equivalence = Equivalence::where('productp_id', $productP->id)
            ->where('producte_id', $productE->id)
            ->first();
            
        if (!$equivalence) {
            // If no specific equivalence found, create a default one with 1:1 value comparison
            $equivalence = new Equivalence([
                'productp_id' => $productP->id,
                'producte_id' => $productE->id,
                'weight_percentage' => 1.0,
                'transfer_cost_p' => 0.05, // Default 5%
                'transfer_cost_e' => 0.03, // Default 3%
            ]);
        }
        
        // Calculate required amount of product E
        $requiredE = $equivalence->calculateEquivalentAmount($quantityP);
        
        // Round up to whole units
        $requiredE = ceil($requiredE);
        
        return response()->json([
            'required_quantity' => $requiredE,
            'product_p_value' => $productP->value,
            'product_e_value' => $productE->value,
            'weight_percentage' => $equivalence->weight_percentage,
            'transfer_cost_p' => $equivalence->transfer_cost_p,
            'transfer_cost_e' => $equivalence->transfer_cost_e,
        ]);
    }

    // Handle the logic for initiating a trade
    public function initiateTrade(Request $request)
    {
        $request->validate([
            'productp_id' => 'required|exists:products,id',
            'producte_id' => 'required|exists:products,id',
            'quantity_p' => 'required|integer|min:1',
            'quantity_e' => 'required|integer|min:1',
            'counterparty_id' => 'required|exists:users,id',
            'partner_b' => 'required|exists:users,id',
        ]);

        $initiator_id = auth()->id();       // Role A
        $counterparty_id = $request->counterparty_id; // Role X
        $partner_b_id = $request->partner_b;  // Role B
        
        // Get the counterparty's partner as Partner Y
        $counterparty = User::find($counterparty_id);
        $partner_y_id = $counterparty->partner_id; // Role Y
        
        $productp_id = $request->productp_id;
        $producte_id = $request->producte_id;
        $quantity_p = $request->quantity_p;
        $quantity_e = $request->quantity_e;

        // Validation checks
        if ($initiator_id == $counterparty_id) {
            return redirect()->route('offers')->with('error', 'You cannot initiate a trade with yourself.');
        }

        if ($partner_b_id == $initiator_id || $partner_b_id == $counterparty_id) {
            return redirect()->route('offers')->with('error', 'Your partner (B) cannot be yourself or the counterparty.');
        }

        if ($partner_y_id && ($partner_y_id == $counterparty_id || $partner_y_id == $initiator_id || $partner_y_id == $partner_b_id)) {
            return redirect()->route('offers')->with('error', 'The counterparty\'s partner (Y) cannot be the same as any other party in the trade.');
        }

        // Check if the counterparty has enough of the requested product (P)
        $counterpartyInventory = UserProduct::where('user_id', $counterparty_id)
            ->where('product_id', $productp_id)
            ->first();
            
        if (!$counterpartyInventory || $counterpartyInventory->quantity < $quantity_p) {
            return redirect()->route('offers')->with('error', 'The counterparty does not have enough quantity of that product available.');
        }
        
        // Check if the partner has enough of the offered product (E)
        $partnerInventory = UserProduct::where('user_id', $partner_b_id)
            ->where('product_id', $producte_id)
            ->first();
            
        if (!$partnerInventory || $partnerInventory->quantity < $quantity_e) {
            return redirect()->route('offers')->with('error', 'Your partner does not have enough quantity of the product to offer.');
        }

        // Check for an existing pending transaction
        $pendingTransaction = Transaction::where('productp_id', $productp_id)
            ->where('producte_id', $producte_id)
            ->where('initiator_id', $initiator_id)
            ->where('counterparty_id', $counterparty_id)
            ->where('status', 'Pending')
            ->first();

        if ($pendingTransaction) {
            return redirect()->route('offers')->with('error', 'There is already a pending trade for these products.');
        }

        // Generate secure 16-digit hash key for the four-party transaction
        $hashkey = bin2hex(random_bytes(8));
        // Split hash for anonymity - first half for party A, second half for party Y
        $hashFirst = substr($hashkey, 0, 8);
        $hashSecond = substr($hashkey, 8, 8);
        
        // Find the appropriate equivalence for fee calculation
        $equivalence = Equivalence::where('productp_id', $productp_id)
            ->where('producte_id', $producte_id)
            ->first();
            
        if (!$equivalence) {
            // Default values if no specific equivalence exists
            $transferCostP = 0.05; // 5%
            $transferCostE = 0.03; // 3%
        } else {
            $transferCostP = $equivalence->transfer_cost_p;
            $transferCostE = $equivalence->transfer_cost_e;
        }
        
        // Calculate transaction fee based on values
        $productP = Product::find($productp_id);
        $productE = Product::find($producte_id);
        
        $valuePWithCost = $productP->value * $quantity_p * $transferCostP;
        $valueEWithCost = $productE->value * $quantity_e * $transferCostE;
        $totalFee = $valuePWithCost + $valueEWithCost;

        // Create a new transaction with four-party information, using auto-increment ID
        $transaction = new Transaction([
            'initiator_id' => $initiator_id, // Role A
            'counterparty_id' => $counterparty_id, // Role X
            'partner_b_id' => $partner_b_id, // Role B
            'partner_y_id' => $partner_y_id, // Role Y
            'productp_id' => $productp_id, // Product from X to A
            'producte_id' => $producte_id, // Product from B to Y
            'quantity_p' => $quantity_p,
            'quantity_e' => $quantity_e,
            'status' => 'Pending',
            'hashkey' => $hashkey, // Store the full hash
            'hash_key' => $hashkey, // Store the full hash (duplicate for backward compatibility)
            'hash_first' => $hashFirst, // First half for A
            'hash_second' => $hashSecond, // Second half for Y
            'last_action_by' => $initiator_id,
            'fee_amount' => $totalFee,
            'transaction_fee_total' => $totalFee // Duplicate for backward compatibility
        ]);
        
        $transaction->save();
        
        // Determine if Y exists and provide appropriate message
        $successMessage = 'Four-party trade initiated successfully! Your hash key part is: ' . $hashFirst;
        if (!$partner_y_id) {
            $successMessage .= ' Note: The counterparty does not have a partner set yet. They will need to select one to complete the four-party exchange.';
        }
        
        return redirect()->route('offers')->with('success', $successMessage);
    }

    public function acceptTrade(Transaction $transaction)
    {
        // Debug the transaction details with only essential information
        \Log::info('Accepting Trade', [
            'transaction_id' => $transaction->transaction_id,
            'current_user' => auth()->id()
        ]);

        // Ensure the transaction is in 'pending' or 'countered' state (keep for backward compatibility)
        if (!in_array($transaction->status, ['Pending', 'Countered'])) {
            return redirect()->route('offers')->with('error', 'Trade has already been processed.');
        }

        // Verify the current user is authorized to accept
        $currentUserId = auth()->id();
        $isCounterInitiator = $transaction->status === 'Countered' && $transaction->initiator_id === $currentUserId;
        
        if (!$isCounterInitiator && $transaction->counterparty_id != $currentUserId) {
            return redirect()->route('offers')->with('error', 'You are not authorized to accept this trade.');
        }
        
        // Load the products to verify values
        $productP = Product::find($transaction->productp_id);
        $productE = Product::find($transaction->producte_id);
        
        if (!$productP || !$productE) {
            return redirect()->route('offers')->with('error', 'One or more products in this trade no longer exist.');
        }
        
        // Check if the counterparty still has enough inventory
        $counterpartyInventory = UserProduct::where('user_id', $transaction->counterparty_id)
            ->where('product_id', $transaction->productp_id)
            ->first();
            
        if (!$counterpartyInventory || $counterpartyInventory->quantity < $transaction->quantity_p) {
            return redirect()->route('offers')->with('error', 'The counterparty no longer has enough quantity of the requested product.');
        }
        
        // Check if the partner B still has enough inventory of product E
        $partnerBInventory = UserProduct::where('user_id', $transaction->partner_b_id)
            ->where('product_id', $transaction->producte_id)
            ->first();
            
        if (!$partnerBInventory || $partnerBInventory->quantity < $transaction->quantity_e) {
            return redirect()->route('offers')->with('error', 'The initiator\'s partner no longer has enough quantity of their offered product.');
        }

        // Begin transaction to ensure atomicity
        \DB::beginTransaction();
        
        try {
            // Reduce quantities from sellers
            \Log::info('Processing trade', [
                'transaction_id' => $transaction->transaction_id
            ]);
            
            // Reduce quantity from Partner B (not initiator)
            $partnerBInventory->quantity -= $transaction->quantity_e;
            $counterpartyInventory->quantity -= $transaction->quantity_p;
            
            // Save changes
            $partnerBInventory->save();
            $counterpartyInventory->save();
            
            // Apply transfer costs
            $equivalence = Equivalence::where('productp_id', $transaction->productp_id)
                ->where('producte_id', $transaction->producte_id)
                ->first();
                
            if (!$equivalence) {
                // Default values if no specific equivalence exists
                $transferCostP = 0.05; // 5%
                $transferCostE = 0.03; // 3%
            } else {
                $transferCostP = $equivalence->transfer_cost_p;
                $transferCostE = $equivalence->transfer_cost_e;
            }
            
            // Calculate quantities after transfer costs
            $quantityPAfterCost = floor($transaction->quantity_p * (1 - $transferCostP));
            $quantityEAfterCost = floor($transaction->quantity_e * (1 - $transferCostE));
            
            // Make sure we always transfer at least 1 of each product if the original quantity was at least 1
            if ($transaction->quantity_p >= 1 && $quantityPAfterCost < 1) {
                $quantityPAfterCost = 1;
            }
            if ($transaction->quantity_e >= 1 && $quantityEAfterCost < 1) {
                $quantityEAfterCost = 1;
            }
            
            // Add quantities to proper recipients
            // Initiator (A) receives product P
            $initiatorReceivesProduct = UserProduct::firstOrCreate(
                ['user_id' => $transaction->initiator_id, 'product_id' => $transaction->productp_id],
                ['quantity' => 0]
            );
            
            // Partner Y receives product E (if Y exists)
            if ($transaction->partner_y_id) {
                $partnerYReceivesProduct = UserProduct::firstOrCreate(
                    ['user_id' => $transaction->partner_y_id, 'product_id' => $transaction->producte_id],
                    ['quantity' => 0]
                );
                $partnerYReceivesProduct->quantity += $quantityEAfterCost;
                $partnerYReceivesProduct->save();
            } else {
                // Fallback: If no Partner Y, then Counterparty (X) receives it
                $counterpartyReceivesProduct = UserProduct::firstOrCreate(
                    ['user_id' => $transaction->counterparty_id, 'product_id' => $transaction->producte_id],
                    ['quantity' => 0]
                );
                $counterpartyReceivesProduct->quantity += $quantityEAfterCost;
                $counterpartyReceivesProduct->save();
            }
            
            // Update initiator inventory
            $initiatorReceivesProduct->quantity += $quantityPAfterCost;
            $initiatorReceivesProduct->save();
            
            // Update transaction status
            $transaction->status = 'Completed';
            $transaction->completed_at = now();
            $transaction->last_action_by = $currentUserId;
            $transaction->save();
            
            \DB::commit();
            
            // Summarize the trade for the success message
            $summary = "Four-party trade completed successfully! ";
            
            if ($currentUserId == $transaction->initiator_id) {
                $summary .= "You received {$quantityPAfterCost} {$productP->name}.";
            } else if ($currentUserId == $transaction->counterparty_id) {
                if (!$transaction->partner_y_id) {
                    $summary .= "You gave {$transaction->quantity_p} {$productP->name} and received {$quantityEAfterCost} {$productE->name}.";
                } else {
                    $summary .= "You gave {$transaction->quantity_p} {$productP->name}.";
                }
            }
            
            return redirect()->route('offers')->with('success', $summary);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Trade acceptance failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('offers')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function rejectTrade(Transaction $transaction)
    {
        // Ensure the transaction is in 'pending' or 'countered' state
        if (!in_array($transaction->status, ['Pending', 'Countered'])) {
            return redirect()->route('offers')->with('error', 'Trade has already been processed.');
        }

        // Verify the current user is involved in the transaction
        if ($transaction->counterparty_id != auth()->id() && $transaction->initiator_id != auth()->id()) {
            return redirect()->route('offers')->with('error', 'You are not authorized to reject this trade.');
        }

        $transaction->status = 'Rejected';
        $transaction->last_action_by = auth()->id();
        $transaction->save();

        return redirect()->route('offers')->with('success', 'Trade rejected.');
    }

    // Method to finalize the transaction after both hash parts are provided
    public function finalizeTransaction(Request $request, Transaction $transaction)
    {
        $request->validate([
            'hash_verification' => 'required|string|size:16',
        ]);
        
        // Verify the hash matches
        if ($request->hash_verification !== $transaction->hashkey) {
            return redirect()->route('offers')->with('error', 'Invalid verification code. The transaction cannot be completed.');
        }
        
        // Verify the transaction is in 'Accepted' status
        if ($transaction->status !== 'Accepted') {
            return redirect()->route('offers')->with('error', 'This transaction is not ready to be finalized.');
        }
        
        // Update the inventory - reduce quantities from the trading parties
        $initiatorInventory = UserProduct::where('user_id', $transaction->initiator_id)
            ->where('product_id', $transaction->producte_id)
            ->first();
            
        $counterpartyInventory = UserProduct::where('user_id', $transaction->counterparty_id)
            ->where('product_id', $transaction->productp_id)
            ->first();
            
        if (!$initiatorInventory || !$counterpartyInventory) {
            return redirect()->route('offers')->with('error', 'Inventory records not found. Cannot complete the transaction.');
        }
        
        // Begin transaction to ensure atomicity
        \DB::beginTransaction();
        
        try {
            // Reduce quantities from sellers
            $initiatorInventory->quantity -= $transaction->quantity_e;
            $counterpartyInventory->quantity -= $transaction->quantity_p;
            
            // Save changes
            $initiatorInventory->save();
            $counterpartyInventory->save();
            
            // Add quantities to buyers (ensuring records exist)
            $initiatorReceivesProduct = UserProduct::firstOrCreate(
                ['user_id' => $transaction->initiator_id, 'product_id' => $transaction->productp_id],
                ['quantity' => 0]
            );
            
            $counterpartyReceivesProduct = UserProduct::firstOrCreate(
                ['user_id' => $transaction->counterparty_id, 'product_id' => $transaction->producte_id],
                ['quantity' => 0]
            );
            
            // Apply transfer costs
            $equivalence = Equivalence::where('productp_id', $transaction->productp_id)
                ->where('producte_id', $transaction->producte_id)
                ->first();
                
            if (!$equivalence) {
                // Default values if no specific equivalence exists
                $transferCostP = 0.05; // 5%
                $transferCostE = 0.03; // 3%
            } else {
                $transferCostP = $equivalence->transfer_cost_p;
                $transferCostE = $equivalence->transfer_cost_e;
            }
            
            // Calculate quantities after transfer costs
            $quantityPAfterCost = floor($transaction->quantity_p * (1 - $transferCostP));
            $quantityEAfterCost = floor($transaction->quantity_e * (1 - $transferCostE));
            
            // Make sure we always transfer at least 1 of each product if the original quantity was at least 1
            if ($transaction->quantity_p >= 1 && $quantityPAfterCost < 1) {
                $quantityPAfterCost = 1;
            }
            if ($transaction->quantity_e >= 1 && $quantityEAfterCost < 1) {
                $quantityEAfterCost = 1;
            }
            
            // Update receiving inventories with post-cost quantities
            $initiatorReceivesProduct->quantity += $quantityPAfterCost;
            $counterpartyReceivesProduct->quantity += $quantityEAfterCost;
            
            $initiatorReceivesProduct->save();
            $counterpartyReceivesProduct->save();
            
            // Update transaction status
            $transaction->status = 'Completed';
            $transaction->completed_at = now();
            $transaction->save();
            
            \DB::commit();
            
            return redirect()->route('offers')->with('success', 'Transaction completed successfully! Products have been exchanged.');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('offers')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
