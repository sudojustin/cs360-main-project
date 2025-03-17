<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class OfferController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('offers', compact('products'));
    }
}
