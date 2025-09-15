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
        Schema::create('hris_tools_maternity_entry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line')->default(0);
            $table->unsignedBigInteger('unit')->default(0);
            $table->string('category');
            $table->date('joining_date');
            $table->date('notice_date');
            $table->date('application_date');
            $table->date('possible_delivery_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('leave_start_date');
            $table->date('leave_end_date');
            $table->integer('leave_days');
            $table->enum('approved', ['Y', 'N'])->default('N');
            $table->enum('payment', ['Y', 'N'])->default('N');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('org_id');
            $table->index('category');
            $table->index('approved');
            $table->index('payment');

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_tools_maternity_entry');
    }
};
