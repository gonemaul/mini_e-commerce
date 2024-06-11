<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Web\DashboardController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('home');

    // Admin Profile routes
    Route::get('/profile' ,[UserController::class, 'showAdminProfile'])->name('adminProfile');
    Route::post('/profile' ,[UserController::class, 'changeAdminProfile'])->name('adminChangeProfile');
    Route::get('/changePassword' ,[UserController::class, 'showAdminProfile'])->name('adminShowChangePassword');
    Route::post('/changePassword' ,[UserController::class, 'changePasswordAdmin'])->name('adminChangePassword');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Category Management
    Route::resource('/categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.delete',
        'show' => 'categories.show',
    ]);

    // Product Management
    Route::resource('/products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.delete',
        'show' => 'products.show',
    ]);

    // User Management
    Route::get('/users', [UserController::class, 'user_list'])->name('listUsers');

    // Order Management
    Route::get('/orders', [OrderController::class, 'order_list'])->name('orderList');
    Route::get('/orders/detail/{id}', [OrderController::class, 'order_detail'])->name('orderDetail');
});