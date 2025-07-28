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
        Schema::create('hris_setup_employee_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category')->unique();
            $table->string('category_bn');
            $table->string('category_code')->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();  

            $table->index('category_code');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_employee_categories');
    }
};
