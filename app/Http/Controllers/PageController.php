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
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();

        return view('product_detail')->with([
            'product' => $product,
            'related_products' => $related_products
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
