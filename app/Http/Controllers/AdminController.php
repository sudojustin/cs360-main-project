<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminDashboard()
    {
        // Fetch all users
        $users = User::all();
        $products = Product::all();

        return view('admin-dashboard', compact('users', 'products'));
    }

    public function deleteUser(User $user)
    {
        // Prevent deleting self
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Delete user's products first
        $user->products()->delete();
        
        // Delete the user
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
    
    public function deleteProduct(Product $product)
    {
        // Delete the product
        $product->delete();
        
        return back()->with('success', 'Product deleted successfully.');
    }
}
