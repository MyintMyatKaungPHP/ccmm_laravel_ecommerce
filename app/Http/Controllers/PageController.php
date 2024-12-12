<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    // Home Page
    public function home()
    {
        $filters = request(['search', 'category']);
        $products = Product::filter($filters)->paginate(12)->withQueryString();
        $categories = Category::all();
        return view('index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // Product Detail Page
    public function showProduct(string $id)
    {

        $product = Product::find($id);
        return view('product_detail')->with([
            'product' => $product
        ]);
    }

    // Login Page
    public function login()
    {
        return view('login');
    }

    // Register Page
    public function register()
    {
        return view('register');
    }
}
