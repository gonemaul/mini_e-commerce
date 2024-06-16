<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'auth_user_details']);
    Route::post('/user' , [AuthController::class, 'auth_user_update']);

    // Categories Management
    Route::get('/categories', [CategoryController::class, 'categories_all']);
    Route::get('/categories/{id}/products', [CategoryController::class, 'products_by_category']);

    // Products Management
    Route::get('/products', [ProductController::class, 'show_products']);
    Route::get('/product/{id}', [ProductController::class, 'show_product_details']);

    // Cart Management
    Route::post('/cart', [CartController::class, 'add_to_cart']);
    Route::post('/cart/{productId}', [CartController::class, 'update_quantity']);
    Route::delete('/cart/{productId}', [CartController::class, 'remove_from_cart']);

    // Order Management
    Route::post('/orders', [OrderController::class, 'checkout_orders']);
    Route::get('/orders/history', [OrderController::class, 'order_history']);
});