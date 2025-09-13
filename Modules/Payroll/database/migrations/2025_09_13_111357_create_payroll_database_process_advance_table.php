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
        Schema::create('payroll_database_process_advance', function (Blueprint $table) {
            $table->id();
            $table->string('advance_id')->unique();
            $table->string('actual_advance_id')->unique();
            $table->year('year');
            $table->month('month');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('amount', 18, 2);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('actual_advance_id');
            $table->index('year');
            $table->index('month');

            $table->foreign('advance_id')->references('id')->on('payroll_database_advance')->restrictOnDelete();
            $table->foreign('org_id')->references('id')->on('master_setup_organizations')->restrictOnDelete();
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->restrictOnDelete();
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_database_process_advance');
    }
};
