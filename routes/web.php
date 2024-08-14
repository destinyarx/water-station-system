<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryScheduleController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return Inertia::render('Dashboard_2');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CustomerController::class)->prefix('customers')->group(function () {
    Route::get('/', 'index')->name('customer.index');
    Route::get('/get/{filter}', 'fetchCustomers')->name('customers.get');
    Route::post('/add', 'addCustomer')->name('customers.add');
});

Route::controller(ProductsController::class)->prefix('products')->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::post('/add', 'store')->name('products.add');
    Route::put('/update', 'update')->name('products.update');
    Route::get('/get/{filter}', 'fetchProducts')->name('products.get');
});

Route::controller(SalesController::class)->prefix('sales')->group(function () {
    Route::get('/', 'index')->name('sales.index');
});

Route::controller(DeliveryScheduleController::class)->prefix('delivery-schedules')->group(function () {
    Route::get('', 'index');
    Route::get('/get', 'getDeliverySchedule')->name('delivery-schedules.get');
});

Route::inertia('/dashboard', 'Dashboard');


// Customer test
Route::inertia('/customer/register', 'customer/Register');

// test playground
Route::inertia('/test', 'Test');
Route::inertia('/prime', 'Prime');
Route::inertia('/playground', 'Playground');

require __DIR__.'/auth.php';
