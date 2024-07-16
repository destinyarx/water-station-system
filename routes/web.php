<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// customer
Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/get/customers/{filter}', [CustomerController::class, 'fetchCustomers'])->name('customer.get');

// sales
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

// Customer test
Route::inertia('/customer/register', 'customer/Register');

// test playground
Route::inertia('/test', 'Test');
Route::inertia('/prime', 'Prime');



require __DIR__.'/auth.php';
