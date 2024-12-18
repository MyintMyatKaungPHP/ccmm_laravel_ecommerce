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
    public function productDetail(string $slug)
    {
        // Find the product by its slug
        $product = Product::where('slug', $slug)->first();

        // Check if the product exists, if not return a 404 or appropriate response
        if (!$product) {
            abort(404); // or any other handling, e.g., redirect
        }

        // Fetch related products based on the same category, randomly ordered
        $related_products = Product::where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Return the view with product and related products
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
