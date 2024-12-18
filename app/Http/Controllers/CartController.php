<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the cart items.
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Calculate the grand total by summing the price * quantity for each cart item
        $grandTotal = $carts->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Return the view with the cart items and the grand total
        return view('cart', compact('carts', 'grandTotal'));
    }

    /**
     * Store a newly created cart item or update an existing one.
     */
    public function store(StoreCartRequest $request)
    {
        $validated = $request->validated();

        $cart = Cart::firstOrNew(
            ['user_id' => Auth::id(), 'product_id' => $validated['product_id']]
        );

        $cart->quantity += $validated['quantity'];
        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Update the specified cart item's quantity.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $cart->update($request->validated());

        return redirect()->route('cart.page')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove the specified item from the cart.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.page')->with('success', 'Cart deleted successfully!');
    }
}
