<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserProduct;

class DashboardController extends Controller
{
    /*
    * Show the application dashboard the list of products
    *
    * @return \Illuminate\View\View
    */
    public function index()
    {
        // Fetch all products for dropdown
        $allProducts = Product::all();
        
        // Fetch the user's inventory
        $userInventory = UserProduct::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Fetch user-owned products for backward compatibility
        $products = Product::where('owner_id', Auth::id())->get();

        // Fetch transactions where the user is involved in any capacity
        $transactions = Transaction::with(['productp', 'producte', 'counterparty', 'initiator', 'partnerInitiator', 'partnerCounterparty'])
            ->where(function($query) {
                $query->where('initiator_id', Auth::id())
                    ->orWhere('counterparty_id', Auth::id())
                    ->orWhere('partner_b_id', Auth::id())
                    ->orWhere('partner_y_id', Auth::id());
            })
            ->get();

        // Pass the products to the view
        return view('dashboard', compact('allProducts', 'userInventory', 'products', 'transactions'));
    }

    /**
     * Add a product to user inventory or update its quantity
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInventory(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if the user already has this product in inventory
        $userProduct = UserProduct::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($userProduct) {
            // Update existing product quantity
            $userProduct->quantity = $request->quantity;
            $userProduct->save();
            $message = 'Product quantity updated successfully!';
        } else {
            // Add new product to inventory
            UserProduct::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
            $message = 'Product added to your inventory successfully!';
        }

        return redirect()->route('dashboard')->with('success', $message);
    }

    /**
     * Remove a product from user inventory
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromInventory($id)
    {
        $userProduct = UserProduct::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$userProduct) {
            return redirect()->route('dashboard')->with('error', 'Product not found in your inventory.');
        }

        $userProduct->delete();
        return redirect()->route('dashboard')->with('success', 'Product removed from your inventory successfully!');
    }
}
