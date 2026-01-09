<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // === AUTH ROUTES ===
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

    // === RESOURCE ROUTES ===
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-variants', ProductVariantController::class);
    Route::resource('vendors', VendorController::class);

    // === TESTING / DEMO ROUTES ===
    Route::get('/halo', function () {
        return response()->json(['message' => 'Halo, Laravel API v1!']);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
