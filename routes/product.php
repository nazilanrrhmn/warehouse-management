<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:web'])->group(function () {
    Route::resource('/products', ProductController::class);
});
