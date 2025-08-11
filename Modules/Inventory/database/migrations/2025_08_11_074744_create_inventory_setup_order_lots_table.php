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
        Schema::create('inventory_setup_order_lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('lot_no'); // Lot identifier
            $table->string('lot_description')->nullable();
            $table->string('lot_status')->nullable();
            $table->integer('lot_quantity')->nullable();
            $table->string('lot_remarks')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('expected_shipping_date')->nullable();
            $table->date('actual_shipping_date')->nullable();
            //foreign key
            $table->foreign('order_id')->references('id')->on('inventory_databases_orders')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_order_lots');
    }
};
