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
        Schema::create('payroll_tools_read_machinedata', function (Blueprint $table) {
            $table->id();
            $table->string('secret_number');
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('attendance_date');
            $table->integer('machine_number');
            $table->integer('punch_type');
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('secret_number');
            $table->index('attendance_date');
            $table->index('punch_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_tools_read_machinedata');
    }
};
