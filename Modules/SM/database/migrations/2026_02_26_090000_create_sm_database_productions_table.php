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
        // Removed sm_setup_sewing_groups creation as user wants to use existing Groups table.
        // We only need the pivot table to link Employees to Groups for Sewing.

        Schema::create('sm_database_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id'); 
            $table->unsignedBigInteger('order_id'); 
            $table->unsignedBigInteger('programme_id'); 
            $table->unsignedBigInteger('color_id')->nullable(); 
            $table->unsignedBigInteger('size_id')->nullable(); 
            $table->unsignedBigInteger('sample_type_id')->nullable(); 
            $table->float('production_quantity'); 
            $table->float('used_fabric_quantity'); 
            $table->float('delivery_qty'); 
            $table->float('balance_qty'); 
            $table->date('production_date')->nullable();
            $table->text('production_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_database_productions');
    }
};
