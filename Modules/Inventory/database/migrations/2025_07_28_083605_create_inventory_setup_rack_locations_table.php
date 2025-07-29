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
        Schema::create('inventory_setup_rack_locations', function (Blueprint $table) {
            $table->id();
            $table->string('rack_name', 100)->nullable();
            $table->string('rack_code', 50)->unique();
            $table->string('aisle', 50)->nullable();
            $table->string('row', 20)->nullable();
            $table->string('column', 20)->nullable();
            $table->tinyInteger('floor_level')->nullable();
            $table->unsignedBigInteger('store_line_id');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            // foreign key
            $table->foreign('store_line_id')
                  ->references('id')->on('inventory_setup_store_line')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_rack_locations');
    }
};
