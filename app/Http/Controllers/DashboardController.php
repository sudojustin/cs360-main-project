<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    /*
    * Show the application dashboard the list of products
    *
    * @return \Illuminate\View\View
    */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('dashboard', compact('products'));
    }
}
