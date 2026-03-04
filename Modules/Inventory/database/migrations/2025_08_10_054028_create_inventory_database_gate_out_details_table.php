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
        Schema::create('inventory_database_gate_out_challan_details', function (Blueprint $table) {
            
            $table->id();
            $table->integer('challan_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->decimal('challan_qty', 8, 2)->nullable();
            $table->text('note')->nullable();

            $table->decimal('app_qty', 8, 2)->nullable();
            $table->integer('approved_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('approved_date')->nullable();


            $table->boolean('is_rejected')->default(0);
            $table->integer('rejected_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('rejected_date')->nullable();

            $table->boolean('is_gate_out')->default(0);
            $table->decimal('gate_out_qty', 8, 2)->nullable();
            $table->integer('gate_out_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('gate_out_date')->nullable();

            $table->string('remarks', 255)->nullable();
            $table->string('comment', 255)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_database_pur_requisition_details');
    }
};
