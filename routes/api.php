<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);

    Route::resource('vendors', VendorController::class);
    
    Route::get('/halo', function () {
        return 'Halo, Laravel';
        });
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');
});