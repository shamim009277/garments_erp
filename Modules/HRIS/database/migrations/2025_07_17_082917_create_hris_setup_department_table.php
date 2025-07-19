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
        Schema::create('hris_setup_department', function (Blueprint $table) {
            $table->id();
            $table->string('department', 100)->unique();
            $table->string('department_bn', 100)->nullable();
            $table->foreignId('parent_department_id')->constrained('hris_setup_parent_department')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_department');
    }
};
