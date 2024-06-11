<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [UserController::class, 'user_api']);
Route::post('/user' , [UserController::class, 'update_user_api']);


// Products Management
Route::get('/products', [ProductController::class, 'show_products']);
Route::get('/product/{id}', [ProductController::class, 'show_product_details']);


// Categories Management
Route::get('/categories', [CategoryController::class, 'categories_api']);
Route::get('/categories/{id}/products', [CategoryController::class, 'products_categories_api']);


// Cart Management
Route::post('/cart', [CartController::class, 'cart_api']);
Route::post('/cart/{productId}', [CartController::class, 'update_cart_api']);
Route::delete('/cart/{productId}', [CartController::class, 'delete_cart_api']);


// Order Management
Route::get('/orders', [OrderController::class, 'checkout_api']);
Route::get('/orders/history', [OrderController::class, 'history_checkout_api']);