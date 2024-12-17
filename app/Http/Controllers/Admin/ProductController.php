<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Check if an image file was uploaded
        if ($request->hasFile('images')) {
            // Store the uploaded file and get its path
            $data['images'] = $request->file('images')->store('products', 'public');
        } else {
            // Set a default image URL/path
            $data['images'] = 'https://via.placeholder.com/640x480.png?text=Default+Image';
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
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
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Validate the incoming request
        $data = $request->validated();

        // Check if an image file was uploaded
        if ($request->hasFile('images')) {
            // Delete the old image if it exists
            if ($product->images) {
                \Storage::disk('public')->delete($product->images);
            }

            // Store the new uploaded file and get its path
            $data['images'] = $request->file('images')->store('products', 'public');
        }

        // Update the product with the new data
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
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
