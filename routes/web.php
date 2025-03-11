<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*Route::view('/', 'welcome');*/

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('/');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
