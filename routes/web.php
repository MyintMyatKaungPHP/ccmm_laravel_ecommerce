<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

// Web Page Route
Route::get('/', [PageController::class, 'home'])->name('home.page');
Route::get('category/{id}', [PageController::class, 'showProduct'])->name('show.category.products');
Route::get('/productdetail/{id}', [PageController::class, 'showProduct'])->name('product.detail.page');

// Auth Route
Route::get('/register', [PageController::class, 'register'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [PageController::class, 'login'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Route
Route::name('admin.')
    ->middleware(IsAdmin::class)
    ->prefix('admin/')
    ->group(function () {
        // Resource routes
        Route::resource('products', ProductController::class);

        // Additional routes for trashed items
        Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
        Route::put('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    });
