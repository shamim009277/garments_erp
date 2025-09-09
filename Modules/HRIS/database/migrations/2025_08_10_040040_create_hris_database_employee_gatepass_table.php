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
        Schema::create('hris_database_employee_gatepass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->date('date');
            $table->unsignedBigInteger('purpose_id');
            $table->unsignedBigInteger('reason_id');
            $table->unsignedBigInteger('type_id')->comment('1=Short Time, 2=Full Day');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->time('actual_in')->nullable();
            $table->time('actual_out')->nullable();
            $table->unsignedBigInteger('approved_by');
            $table->unsignedBigInteger('out_by')->nullable();
            $table->unsignedBigInteger('in_by')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('purpose_id')->references('id')->on('hris_setup_emp_gatepass_purpose')->onDelete('cascade');
            $table->foreign('reason_id')->references('id')->on('hris_setup_emp_gatepass_reason')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_gatepass');
    }
};
