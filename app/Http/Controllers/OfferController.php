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
        // $products = Product::where('owner_id', '!=', auth()->id())->get(); // Exclude user's own products
        $products = Product::with(['owner', 'transactions' => function ($query) {
                $query->whereIn('status', ['pending', 'Pending']);
            }])->get();
        return view('offers', compact('products'));
    }

    // Handle the logic for initiating a trade
    public function initiateTrade(Product $product)
    {
        $initiator_id = auth()->id();
        $counterparty_id = $product->owner_id;

        // Check if the initiator is not the owner of the product
        if ($initiator_id == $counterparty_id) {
            return redirect()->route('offers')->with('error', 'You cannot initiate a trade with your own product.');
        }

        // Fetch the counterparty's product (the one they would like in return)
        $counterpartyProduct = Product::where('owner_id', $counterparty_id)->first(); // Or use more precise query if necessary

        // Check if there’s already a pending transaction involving this product and the counterparty's product
        $pendingTransaction = Transaction::where('productp_id', $product->id) // Initiator's product
            ->where('counterparty_id', $counterparty_id) // The other party
            ->where('status', 'Pending')
            ->first();

        if ($pendingTransaction) {
            return redirect()->route('offers')->with('error', 'There is already a pending trade for this product.');
        }

        // Create a new transaction for the trade
        $transaction = Transaction::create([
            'initiator_id' => $initiator_id,
            'counterparty_id' => $counterparty_id,
            'productp_id' => $product->id,          // The product being offered
            'producte_id' => $counterpartyProduct->id, // The product the counterparty offers in return
            'hashkey' => bin2hex(random_bytes(8)),  // Generate a secure 16-digit hash
            'transaction_fee_total' => 0,           // Fee calculation could be added later
            'status' => 'Pending',                  // The trade is pending until accepted by the counterparty
        ]);

        // For now, redirect with a success message
        return redirect()->route('offers')->with('success', 'Trade initiated successfully. Waiting for the counterparty to accept or reject.');
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
}
