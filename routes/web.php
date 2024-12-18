<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

// Web Page Route
Route::get('/', [PageController::class, 'home'])->name('home.page');
Route::get('category/{id}', [PageController::class, 'productDetail'])->name('show.category.products');
Route::get('/productdetail/{id}', [PageController::class, 'productDetail'])->name('product.detail.page');

// Auth Route
Route::get('/register', [PageController::class, 'register'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [PageController::class, 'login'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart Route
Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart.page');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Admin Route
Route::name('admin.')
    ->middleware(IsAdmin::class)
    ->prefix('admin/')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // // User CRUD
        // Route::resource('users', UserController::class);
        // Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
        // Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        // Route::delete('users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

        // // Product CRUD
        // Route::resource('products', ProductController::class);
        // // Additional routes for trashed items
        // Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
        // Route::put('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
        // Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

        // // Category CRUD
        // Route::resource('categories', CategoryController::class);
        // Route::get('categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
        // Route::patch('categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
        // Route::delete('categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

        // Prefix for Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::resource('/', UserController::class);
            Route::get('trashed', [UserController::class, 'trashed'])->name('trashed');
            Route::put('{user}/restore', [UserController::class, 'restore'])->name('restore');
            Route::delete('{user}/force-delete', [UserController::class, 'forceDelete'])->name('forceDelete');
        });

        // Prefix for Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::resource('/', ProductController::class);
            Route::get('trashed', [ProductController::class, 'trashed'])->name('trashed');
            Route::put('{product}/restore', [ProductController::class, 'restore'])->name('restore');
            Route::delete('{product}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
        });

        // Prefix for Categories
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::resource('/', CategoryController::class);
            Route::get('trashed', [CategoryController::class, 'trashed'])->name('trashed');
            Route::patch('restore/{id}', [CategoryController::class, 'restore'])->name('restore');
            Route::delete('force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
        });
    });
