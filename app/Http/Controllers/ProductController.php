<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request(['search', 'category']);
        $products = Product::filter($filters)->paginate(12);
        $categories = Category::all();
        return view('index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::find($id);
        return view('product_detail')->with([
            'product' => $product
        ]);
    }
}
