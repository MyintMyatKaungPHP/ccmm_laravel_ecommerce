<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);

            $table->foreignId('category_id')
                ->constrained('categories')
                ->onUpdate('cascade') // If the category ID changes, update automatically
                ->onDelete('restrict'); // Prevent deletion if linked in products

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
