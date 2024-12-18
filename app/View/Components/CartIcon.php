<?php

namespace App\View\Components;

use App\Models\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CartIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $products_count = 0;

        if (Auth::check()) {
            $products_count = Cart::where('user_id', Auth::id())->count();
        }
        return view('components.cart-icon')->with(compact('products_count'));
    }
}
