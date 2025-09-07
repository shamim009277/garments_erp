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
        Schema::create('hris_tools_shifting_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->year('year');
            $table->date('date');
            $table->enum('shift', ['A','B','C','D','E','F','G','H','M','N']);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('year');
            $table->index('date');
            $table->index('shift');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_tools_shifting_list');
    }
};
