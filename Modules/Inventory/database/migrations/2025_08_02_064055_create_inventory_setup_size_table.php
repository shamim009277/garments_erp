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
        Schema::create('inventory_setup_size', function (Blueprint $table) {
            $table->id();
            $table->string('size_code', 20)->unique();
            $table->string('size_name', 100);
            $table->integer('size_rank')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('size_group_id');
            //foreign key
            $table->foreign('size_group_id')
                ->references('id')
                ->on('inventory_setup_size_group')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_size');
    }
};
