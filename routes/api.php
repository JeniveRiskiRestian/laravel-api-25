<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/halo', function () {
    return 'Halo, Laravel';
    });

Route::get('/products', [ProductController::class, 'index']);
