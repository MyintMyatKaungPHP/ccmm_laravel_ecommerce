<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController
{
    /**
     * Display a listing of the orders.
     */
    public function orders()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10); // Fetch only orders for the authenticated user
        return view('orders', compact('orders'));
    }

    /**
     * Generate a unique order number combining the current date and random identifiers.
     */
    private function generateOrderNumber()
    {
        $date = now()->format('Ymd');
        $letters = Str::upper(Str::random(3));
        $digits = rand(100, 999);
        return "{$date}-{$letters}{$digits}";
    }

    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'transition_screenshot' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image file
        ]);

        $user = auth()->user();

        $products_userCart = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Calculate the grand total by summing the price * quantity for each cart item
        $grandTotal = $products_userCart->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Handle the transition_screenshot file
        $transitionScreenshotPath = null;
        if ($request->hasFile('transition_screenshot')) {
            $transitionScreenshotPath = $request->file('transition_screenshot')->store('order_screenshots', 'local');
        }

        $order_number = $this->generateOrderNumber();

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $order_number,
            'grand_total' => $grandTotal,
            'shipping_address' => $request->shipping_address,
            'phone_number' => $request->phone_number,
            'notes' => $request->notes,
            'status' => 'pending',
            'transition_screenshot' => $transitionScreenshotPath,
        ]);

        // Create OrderDetail records
        foreach ($products_userCart as $product) {
            $order->orderDetails()->create([
                'order_id' => $order_number,
                'product_id' => $product->product_id,
                'quantity' => $product->quantity,
                'price' => $product->product->price,
                'subtotal' => $product->product->price * $product->quantity,
            ]);
        }

        // Clear the cart
        $user->cart()->detach();

        return redirect()->route('orders.page')->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in the database.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'shipping_address' => 'required|string|max:255',
        ]);

        $order->update($request->only(['status', 'shipping_address']));

        return redirect()->route('orders.page')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from the database (soft delete).
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.page')->with('success', 'Order deleted successfully!');
    }
}
