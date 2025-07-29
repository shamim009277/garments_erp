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
        Schema::create('inventory_setup_goods_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20)->unique();  // e.g., RM01, FG02
            $table->string('name', 100);                   // e.g., Raw Material, Finished Goods
            $table->text('description')->nullable();       // Optional details
            $table->unsignedBigInteger('parent_id')->nullable(); // For hierarchical categories
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            // Optional: Add foreign key if hierarchical
            $table->foreign('parent_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_goods_categories');
    }
};
