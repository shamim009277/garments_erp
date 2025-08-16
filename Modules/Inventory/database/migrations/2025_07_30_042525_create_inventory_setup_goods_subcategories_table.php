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
        Schema::create('inventory_setup_goods_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_category_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('name');
            $table->string('sub_category_code', 20)->nullable();
            $table->string('bn_name')->nullable();
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            //foreign key
            $table->foreign('goods_category_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_goods_subcategories');
    }
};
