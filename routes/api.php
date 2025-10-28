<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/halo', function () {
    return 'Halo, Laravel';
    });

Route::get('/productposts', [ProductController::class, 'index']);
Route::post('/product-store', [ProductController::class, 'store']);
Route::resource('vendors', VendorController::class);