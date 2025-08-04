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
        Schema::create('inventory_setup_items', function (Blueprint $table) {
            $table->id();
            //relationship
            $table->unsignedBigInteger('goods_category_id');
            $table->unsignedBigInteger('goods_subcategory_id');
            $table->unsignedBigInteger('unit_id');
            //items info 
            $table->string('item_code', 20)->unique(); // Like IT001
            $table->string('item_name', 100);
            $table->string('item_description')->nullable();
            $table->string('item_barcode')->nullable();
            $table->string('item_image')->nullable();
            $table->boolean('is_active')->default(true);
            //varient 
            $table->json('varient')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('remarks')->nullable();
            //present stock
            $table->integer('present_stock')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('maximum_stock')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->integer('reorder_quantity')->default(0);
            //foreign key
            $table->foreign('goods_category_id')
                ->references('id')
                ->on('inventory_setup_goods_categories')
                ->onDelete('restrict');
            $table->foreign('goods_subcategory_id')
                ->references('id')
                ->on('inventory_setup_goods_subcategories')
                ->onDelete('restrict');
            $table->foreign('unit_id')
                ->references('id')
                ->on('master_setup_units')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_items');
    }
};
