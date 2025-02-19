<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:web'])->group(function () {
    Route::resource('/suppliers', SupplierController::class);
});
