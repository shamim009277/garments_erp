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
        Schema::create('inventory_setup_order_lot_color_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_lot_color_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('size_quantity')->nullable();
            $table->string('size_remarks')->nullable();
            
            //foreign key
            $table->foreign('order_lot_color_id')->references('id')->on('inventory_setup_order_lot_colors')->onDelete('restrict');
            $table->foreign('size_id')->references('id')->on('inventory_setup_size')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_order_lot_color_sizes');
    }
};
