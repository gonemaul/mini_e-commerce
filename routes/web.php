<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
//     Route::post('/login', [AuthController::class, 'login'])->name('login');
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
//     Route::post('/register', [AuthController::class, 'register'])->name('register');
// });
Route::get('/', function (){
    return view('home')->with([
        'title' => 'HOME'
    ]);
})->name('home');

Route::middleware(['auth', 'is_admin'])->group(function () {
    // WebAdmin routes
    Route::get('/profile' ,[UserController::class, 'adminProfile'])->name('adminProfile');
    Route::post('/profile' ,[UserController::class, 'adminChangeProfile'])->name('adminChangeProfile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Category Management
    Route::resource('/categories', CategoryController::class);

    // Product Management
    Route::resource('/products', ProductController::class);

    // User Management
    Route::get('/users', [UserController::class, 'listUsers'])->name('listUsers');

    // Order Management
    Route::resource('/order', OrderController::class);
});