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
        Schema::create('om_setup_bom_setups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->decimal('consumption', 18, 4)->nullable();
            $table->decimal('consumption_pcs', 18, 4)->nullable();
            $table->decimal('convert_ratio', 18, 4)->nullable();
            $table->unsignedBigInteger('consumption_unit_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->decimal('extra', 18, 2)->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('breakdown_id')->nullable();
            $table->date('create_date')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('inventory_setup_buyer')->onDelete('restrict');
            $table->foreign('item_id')->references('id')->on('inventory_setup_items')->onDelete('restrict');
            $table->foreign('consumption_unit_id')->references('id')->on('master_setup_units')->onDelete('restrict');
            $table->foreign('unit_id')->references('id')->on('master_setup_units')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('inventory_setup_suppliers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_setup_bom_setups');
    }
};
