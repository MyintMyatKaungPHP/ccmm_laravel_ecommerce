<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Display a list of trashed products.
     */
    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(10);
        return view('admin.products.trashed', compact('products'));
    }

    /**
     * Restore a trashed product.
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.trashed')->with('success', 'Product restored successfully!');
    }

    /**
     * Permanently delete a trashed product.
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                \Storage::disk('public')->delete($image); // Delete stored images
            }
        }

        $product->forceDelete();

        return redirect()->route('admin.products.trashed')->with('success', 'Product permanently deleted!');
    }
}
