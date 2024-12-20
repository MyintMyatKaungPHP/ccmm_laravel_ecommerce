<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\OrderController;

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

// Auth Check Routes
Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        // Display the cart page
        Route::get('/', [CartController::class, 'index'])->name('page');

        // Store a new item in the cart
        Route::post('/', [CartController::class, 'store'])->name('store');

        // Update an item in the cart
        Route::put('{cart}', [CartController::class, 'update'])->name('update');

        // Remove an item from the cart
        Route::delete('{cart}', [CartController::class, 'destroy'])->name('destroy');
    });

    // Order Routes
    Route::prefix('orders')->name('orders.')->group(function () {
        // Route::get('trashed', [OrderController::class, 'trashed'])->name('trashed');
        // Route::patch('restore/{order}', [OrderController::class, 'restore'])->name('restore');
        // Route::delete('force-delete/{order}', [OrderController::class, 'forceDelete'])->name('forceDelete');

        // Show all orders
        Route::get('/', [OrderController::class, 'orders'])->name('page');

        // // Show form to create a new order
        // Route::get('create', [OrderController::class, 'create'])->name('create');

        // Store a new order
        Route::post('/', [OrderController::class, 'store'])->name('store');

        // // Show a single order
        // Route::get('{order}', [OrderController::class, 'show'])->name('show');

        // // Show the form to edit an existing order
        // Route::get('{order}/edit', [OrderController::class, 'edit'])->name('edit');

        // // Update an existing order
        // Route::put('{order}', [OrderController::class, 'update'])->name('update');

        // // Delete an order
        // Route::delete('{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
});



// Admin Route
Route::name('admin.')
    ->middleware(IsAdmin::class)
    ->prefix('admin/')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Categories CRUD
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('trashed', [CategoryController::class, 'trashed'])->name('trashed');
            Route::patch('restore/{id}', [CategoryController::class, 'restore'])->name('restore');
            Route::delete('force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
            Route::resource('/', CategoryController::class)->parameters(['' => 'category']);
        });

        // Users CRUD
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('trashed', [UserController::class, 'trashed'])->name('trashed');
            Route::put('{user}/restore', [UserController::class, 'restore'])->name('restore');
            Route::delete('{user}/force-delete', [UserController::class, 'forceDelete'])->name('forceDelete');
            Route::resource('/', UserController::class);
        });

        // Products CURD
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('trashed', [ProductController::class, 'trashed'])->name('trashed');
            Route::put('{product}/restore', [ProductController::class, 'restore'])->name('restore');
            Route::delete('{product}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');
            Route::resource('/', ProductController::class);
        });
    });
