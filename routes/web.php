<?php

use App\Http\Controllers\Admin_ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/productdetail/{id}', [ProductController::class, 'show']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/register', [PageController::class, 'register']);

Route::get('/category/{id}', function (Category $category) {
    return view('index')->with([
        'category' => $category,
        'products' => $category->products()->paginate(12)
    ]);
});


// Admin Route

// Product
Route::get('/admin/products', [Admin_ProductController::class, 'index']);
Route::get('/admin/products/create', [Admin_ProductController::class, 'create']);
Route::post('/admin/products/create', [Admin_ProductController::class, 'store']);
Route::get('/admin/products/{id}', [Admin_ProductController::class, 'show']);
Route::get('/admin/products/{id}/edit', [Admin_ProductController::class, 'edit']);
Route::put('/admin/products/{id}', [Admin_ProductController::class, 'update']);
Route::delete('/admin/products/{id}', [Admin_ProductController::class, 'destroy']);
