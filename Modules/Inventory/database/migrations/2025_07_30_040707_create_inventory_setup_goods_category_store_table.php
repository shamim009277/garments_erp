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
        Schema::create('inventory_setup_goods_category_store', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_category_id');
            $table->unsignedBigInteger('store_id');
            $table->timestamps();
            $table->foreign('goods_category_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('inventory_setup_stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_goods_category_store');
    }
};
