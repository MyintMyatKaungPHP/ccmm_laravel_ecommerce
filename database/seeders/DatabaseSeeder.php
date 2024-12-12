<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User seeder
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'is_admin' => 1
        ]);
        User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@email.com',
        ]);


        // Categories seeder
        $categories = [
            'Electronics',
            'Books',
            'Fashion',
            'Home & Kitchen',
            'Health & Beauty',
            'Sports',
            'Toys & Games',
            'Automotive',
            'Music Instruments',
            'Groceries',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => str::slug($categoryName),
            ]);
        }

        // Pruduct seeder via factory
        Product::factory(100)->create();
    }
}
