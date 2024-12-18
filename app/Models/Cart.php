<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    // The table name for the cart pivot table
    protected $table = 'carts';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * The user associated with the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product associated with the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
