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
        Schema::create('hris_database_leave_application', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_id')->unsigned();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('reason_id');
            $table->date('application_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days');

            $table->char('is_forward')->default('N');
            $table->unsignedBigInteger('forward_by')->nullable();
            $table->date('forward_date')->nullable();

            $table->char('is_approved')->default('N');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approved_date')->nullable();

            $table->char('is_rejected')->default('N');
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->date('rejected_date')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index(['form_id','employee_id','application_date','is_forward','is_approved','is_rejected','forward_by','approved_by','rejected_by']);

            $table->foreign('leave_type_id')->references('id')->on('hris_setup_leaveclassifications')->onDelete('cascade');
            $table->foreign('reason_id')->references('id')->on('hris_setup_leave_reasons')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_leave_application');
    }
};
