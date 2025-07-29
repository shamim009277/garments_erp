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
        Schema::create('hris_setup_departments', function (Blueprint $table) {
            $table->id();
            $table->string('department', 100)->unique();
            $table->string('department_bn', 100)->nullable();
            $table->unsignedBigInteger('parent_department_id');
            $table->integer('approved_mp')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('parent_department_id')->references('id')->on('hris_setup_parent_departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_departments');
    }
};
