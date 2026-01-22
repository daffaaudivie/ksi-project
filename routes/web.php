<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\TransaksiController;
use App\Http\Controllers\Admin\CabangController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('cabang', CabangController::class);


    // Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    // Route::resource('branches', \App\Http\Controllers\Admin\CabangController::class);
    // Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
    // Route::resource('transactions', \App\Http\Controllers\Admin\TransaksiController::class);
});

Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transaksi', TransaksiController::class);
    Route::get(
        'transaksi-export',
        [TransaksiController::class, 'export']
    )->name('transaksi.export');
});

require __DIR__ . '/auth.php';
