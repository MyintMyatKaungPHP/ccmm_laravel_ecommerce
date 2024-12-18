<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Added the missing semicolon here

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // Generates a random product name
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']); // Creates a slug from the product name
            },
            'images' => $this->faker->imageUrl(640, 480, 'products', true), // Random image URL
            'description' => $this->faker->paragraph(4), // Random description
            'price' => $this->faker->randomFloat(2, 5, 500), // Random price between 5 and 500
            'category_id' => Category::inRandomOrder()->first()->id, // Random category ID
        ];
    }
}
