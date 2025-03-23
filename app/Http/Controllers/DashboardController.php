<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $products = Product::where('owner_id', auth()->user()->id)->get();

        // Fetch all user's ongoing barter transactions
        $transactions = Transaction::with(['productp', 'producte', 'counterparty'])->get();

        // Pass the products to the view
        return view('dashboard', compact('products', 'transactions'));
    }
}
