<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

/*Route::view('/', 'welcome');*/

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('/');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Product Management (within Dashboard)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/dashboard/product', [DashboardController::class, 'storeProduct'])->name('dashboard.product.store');
    Route::delete('/dashboard/product/{product}', [DashboardController::class, 'deleteProduct'])->name('dashboard.product.delete');
});

// Route for displaying offers
Route::get('/offers', [OfferController::class, 'index'])->name('offers');

// Route for initiating trade
Route::post('/trade/initiate/{product}', [OfferController::class, 'initiateTrade'])->name('trade.initiate');

Route::post('/trade/accept/{transaction}', [OfferController::class, 'acceptTrade'])->name('trade.accept');
Route::post('/trade/reject/{transaction}', [OfferController::class, 'rejectTrade'])->name('trade.reject');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
