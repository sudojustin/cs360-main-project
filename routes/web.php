<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('/');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    // User Inventory Management
    Route::post('/dashboard/inventory', [DashboardController::class, 'updateInventory'])->name('dashboard.inventory.update');
    Route::delete('/dashboard/inventory/{id}', [DashboardController::class, 'removeFromInventory'])->name('dashboard.inventory.remove');
});

// Trade-related routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Route for displaying offers
    Route::get('/offers', [OfferController::class, 'index'])->name('offers');
    
    // Route for fetching partner products
    Route::get('/partner/{user}/products', [OfferController::class, 'getPartnerProducts'])->name('partner.products');
    
    // Route for calculating equivalent amounts based on the equivalence table
    Route::post('/trade/calculate-equivalent', [OfferController::class, 'calculateEquivalent'])->name('trade.calculate');
    
    // Route for initiating trade (updated to not require product parameter)
    Route::post('/trade/initiate', [OfferController::class, 'initiateTrade'])->name('trade.initiate');
    
    // Routes for accepting, rejecting, and making counteroffers
    Route::post('/trade/accept/{transaction}', [OfferController::class, 'acceptTrade'])->name('trade.accept');
    Route::post('/trade/reject/{transaction}', [OfferController::class, 'rejectTrade'])->name('trade.reject');
    Route::post('/trade/counteroffer/{transaction}', [OfferController::class, 'counterOffer'])->name('trade.counteroffer');
    
    // Route for finalizing transaction with complete hash
    Route::post('/trade/finalize/{transaction}', [OfferController::class, 'finalizeTransaction'])->name('trade.finalize');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::delete('/admin/transactions/{transaction}', [AdminController::class, 'deleteTransaction'])->name('admin.transactions.delete');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/admin/users/{user}/toggle-approval', [AdminController::class, 'toggleUserApproval'])->name('admin.users.toggle-approval');
    Route::patch('/admin/users/{user}/toggle-suspension', [AdminController::class, 'toggleUserSuspension'])->name('admin.users.toggle-suspension');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
