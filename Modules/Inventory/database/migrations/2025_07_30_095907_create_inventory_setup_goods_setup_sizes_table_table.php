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
        Schema::create('inventory_setup_goods_setup_sizes_table', function (Blueprint $table) {
            $table->id();
            $table->string('size_code', 20)->unique();
            $table->string('size_name', 100);
            // Optional: Link to size group (if size group table exists)
            $table->unsignedBigInteger('size_group_id')->nullable();
            $table->foreign('size_group_id')->references('id')->on('inventory_setup_goods_setup_size_groups')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_goods_setup_sizes_table');
    }
};
