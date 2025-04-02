<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    /*
    * Show the application dashboard the list of products
    *
    * @return \Illuminate\View\View
    */
    public function index()
    {
        // Fetch all products and transactions from the database
        $products = Product::where('owner_id', Auth::id())->get();

        // Fetch transactions where the user is involved in any capacity
        $transactions = Transaction::with(['productp', 'producte', 'counterparty', 'initiator', 'partnerInitiator', 'partnerCounterparty'])
            ->where(function($query) {
                $query->where('initiator_id', Auth::id())
                    ->orWhere('counterparty_id', Auth::id())
                    ->orWhere('partner_initiator_id', Auth::id())
                    ->orWhere('partner_counterparty_id', Auth::id());
            })
            ->get();

        // Pass the products to the view
        return view('dashboard', compact('products', 'transactions'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1'
        ]);

        Product::create([
            'owner_id' => Auth::id(),
            'name' => $request->name,
            'value' => $request->value,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('dashboard')->with('success', 'Product added successfully!');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->owner_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized to delete this product.');
        }

        $product->delete();
        return redirect()->route('dashboard')->with('sucess', 'Product deleted successfully!');
    }
}
