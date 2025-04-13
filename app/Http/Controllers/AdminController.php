<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminDashboard()
    {
        // Fetch all users
        $users = User::all();
        $products = Product::all();
        $transactions = Transaction::all();

        return view('admin-dashboard', compact('users', 'products', 'transactions'));
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
    
    public function deleteTransaction(Transaction $transaction)
    {
        // Delete the transaction
        $transaction->delete();
        
        return back()->with('success', 'Transaction deleted successfully.');
    }

    public function toggleUserApproval(User $user)
    {
        $user->update(['is_approved' => !$user->is_approved]);
        
        return back()->with('success', $user->is_approved 
            ? "User {$user->name} has been approved." 
            : "Approval for {$user->name} has been revoked.");
    }

    public function dashboard()
    {
        $users = User::all();
        $transactions = Transaction::with(['sender', 'receiver'])->latest()->get();
        
        return view('admin-dashboard', compact('users', 'transactions'));
    }
}
