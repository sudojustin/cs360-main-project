<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class OfferController extends Controller
{
    // Show the offers page with all available products
    public function index()
    {
        // Exclude the current user's products from the offers page
        $products = Product::with(['owner', 'transactions' => function ($query) {
                $query->whereIn('status', ['pending', 'Pending']);
            }])
            ->where('owner_id', '!=', auth()->id())
            ->get();
            
        // Get the user's own products to select from when initiating a trade
        $userProducts = Product::where('owner_id', auth()->id())->get();
        
        // Get pending transaction offers from other users
        $pendingOffers = \App\Models\Transaction::with(['initiator', 'productp', 'producte'])
            ->where('counterparty_id', auth()->id())
            ->whereIn('status', ['pending', 'Pending'])
            ->get();
            
        return view('offers', compact('products', 'userProducts', 'pendingOffers'));
    }

    // Handle the logic for initiating a trade
    public function initiateTrade(Request $request, Product $product)
    {
        $request->validate([
            'user_product_id' => 'required|exists:products,id',
            'offer_quantity' => 'required|integer|min:1',
            'request_quantity' => 'required|integer|min:1',
            'product_owner' => 'required|in:self,partner',
        ]);

        $initiator_id = auth()->id();
        $counterparty_id = $product->owner_id;

        // Check if the initiator is not the owner of the product
        if ($initiator_id == $counterparty_id) {
            return redirect()->route('offers')->with('error', 'You cannot initiate a trade with your own product.');
        }

        // Get the user's selected product to offer in the trade
        $userProduct = Product::findOrFail($request->user_product_id);
        
        // Verify product ownership based on the owner parameter
        if ($request->product_owner === 'self') {
            if ($userProduct->owner_id !== $initiator_id) {
                return redirect()->route('offers')->with('error', 'You can only trade products that you own.');
            }
        } else {
            // Check if the product belongs to the user's partner
            $user = auth()->user();
            if (!$user->partner || $userProduct->owner_id !== $user->partner->id) {
                return redirect()->route('offers')->with('error', 'This product does not belong to your partner.');
            }
        }
        
        // Check if the requested quantities are available
        if ($userProduct->quantity < $request->offer_quantity) {
            return redirect()->route('offers')->with('error', 'You do not have enough quantity of your product to offer.');
        }
        
        if ($product->quantity < $request->request_quantity) {
            return redirect()->route('offers')->with('error', 'The owner does not have enough quantity of that product available.');
        }

        // Check if there's already a pending transaction involving this product and the counterparty's product
        $pendingTransaction = Transaction::where('productp_id', $product->id)
            ->where('counterparty_id', $counterparty_id)
            ->where('status', 'Pending')
            ->first();

        if ($pendingTransaction) {
            return redirect()->route('offers')->with('error', 'There is already a pending trade for this product.');
        }

        // Create a new transaction for the trade
        $transaction = Transaction::create([
            'initiator_id' => $initiator_id,
            'counterparty_id' => $counterparty_id,
            'productp_id' => $product->id,
            'quantity_p' => $request->request_quantity,
            'producte_id' => $userProduct->id,
            'quantity_e' => $request->offer_quantity,
            'hashkey' => bin2hex(random_bytes(8)),
            'transaction_fee_total' => 0,
            'status' => 'Pending',
        ]);

        return redirect()->route('offers')->with('success', 'Trade offer sent successfully!');
    }

    public function acceptTrade(Transaction $transaction)
    {
        // Ensure the transaction is in 'pending' state
        if ($transaction->status != 'Pending') {
            return redirect()->route('offers')->with('error', 'Trade has already been processed.');
        }

        // Get the counterparty's product (the one they are offering for exchange)
        $counterpartyProduct = Product::where('owner_id', $transaction->counterparty_id)->first();

        // Check if the counterparty has a product
        if (!$counterpartyProduct) {
            return redirect()->route('offers')->with('error', 'The counterparty has no available product for exchange.');
        }

        // Assign the counterparty's product to the transaction
        $transaction->producte_id = $counterpartyProduct->id; // The product they want in return
        $transaction->status = 'Accepted';
        $transaction->save();

        // Optional: Add logic to finalize the trade (e.g., product exchange, notifications, etc.)
        return redirect()->route('offers')->with('success', 'Trade accepted.');
    }

    public function rejectTrade(Transaction $transaction)
    {
        // Ensure the transaction is in 'pending' state
        if ($transaction->status != 'Pending') {
            return redirect()->route('offers')->with('error', 'Trade has already been processed.');
        }

        $transaction->status = 'Rejected';
        $transaction->save();

        // Optional: Add logic for notifying users or handling rejected trades
        return redirect()->route('offers')->with('error', 'Trade rejected.');
    }

    public function makeCounteroffer(Request $request, Transaction $transaction)
    {
        // Ensure the transaction is in 'pending' state
        if ($transaction->status != 'Pending') {
            return redirect()->route('offers')->with('error', 'Trade has already been processed.');
        }

        // Validate the request
        $request->validate([
            'counteroffer_quantity_want' => 'required|integer|min:1',
            'counteroffer_quantity_offer' => 'required|integer|min:1',
        ]);

        // Check if the user is the counterparty (the one receiving the offer)
        if ($transaction->counterparty_id !== auth()->id()) {
            return redirect()->route('offers')->with('error', 'You can only make counteroffers on offers sent to you.');
        }

        // Update the transaction with the counteroffer
        $transaction->update([
            'status' => 'Pending',
            'counterparty_id' => $transaction->initiator_id,
            'initiator_id' => auth()->id(),
            'quantity_e' => $request->counteroffer_quantity_want,
            'quantity_p' => $request->counteroffer_quantity_offer,
        ]);

        return redirect()->route('offers')->with('success', 'Counteroffer sent successfully!');
    }
}
