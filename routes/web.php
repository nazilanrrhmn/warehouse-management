<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
// use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('home') : redirect()->route('login');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth:web'])->group(function () {
    Route::resource('purchases', PurchaseController::class);
});
Route::middleware(['auth:web'])->group(function () {
    Route::resource('customers', CustomerController::class);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/product.php';
require __DIR__ . '/stock-transaction.php';
require __DIR__ . '/supplier.php';
