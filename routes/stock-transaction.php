<?php

use App\Http\Controllers\StockTransactionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:web'])->group(function () {
    Route::resource('/stock-transactions', StockTransactionController::class);
});
