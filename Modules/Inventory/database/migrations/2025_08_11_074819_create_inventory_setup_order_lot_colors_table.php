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
        Schema::create('inventory_setup_order_lot_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_lot_id');
            $table->unsignedBigInteger('color_id');

            //foreign key
            $table->foreign('order_lot_id')->references('id')->on('inventory_setup_order_lots')->onDelete('restrict');
            $table->foreign('color_id')->references('id')->on('inventory_setup_colors')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_order_lot_colors');
    }
};
