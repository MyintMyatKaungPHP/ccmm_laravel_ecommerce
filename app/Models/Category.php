<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->isForceDeleting()) {
                // Hard delete related products
                $category->products()->forceDelete();
            } else {
                // Soft delete related products
                $category->products()->delete();
            }
        });

        static::restored(function ($category) {
            $category->products()->restore();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
