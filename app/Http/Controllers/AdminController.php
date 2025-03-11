<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminDashboard()
    {
        // Fetch all users
        $users = User::all();

        return view('admin-dashboard', compact('users'));
    }
}
