<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/halo', function () {
    return 'Halo, Laravel';
    });

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product-store', [ProductController::class, 'store']);