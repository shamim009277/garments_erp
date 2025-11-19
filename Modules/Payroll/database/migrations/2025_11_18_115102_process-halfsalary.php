<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('payroll_tools_process_halfsalary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->year('year');
            $table->tinyInteger('month');
            $table->date('base_date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line')->default(0);
            $table->unsignedBigInteger('unit')->default(0);
            $table->char('category', 1);
            $table->char('reason', 1);
            $table->integer('grade')->default(0);
            $table->date('leaving_date')->nullable();
            $table->enum('salary_from_bank', ['Y', 'N'])->default('N');
            $table->string('account_no')->nullable();
            $table->string('mobile_banking')->nullable();
            $table->integer('late_days')->default(0);
            $table->integer('days')->default(0);
            $table->integer('absent_days')->default(0);
            $table->integer('leave_days')->default(0);
            $table->integer('rwh')->default(0);
            $table->integer('wrh')->default(0);
            $table->decimal('basic', 18, 2)->default(0);
            $table->decimal('home_allowance', 18, 2)->default(0);
            $table->decimal('medical_allowance', 18, 2)->default(0);
            $table->decimal('food_allowance', 18, 2)->default(0);
            $table->decimal('other_allowance', 18, 2)->default(0);
            $table->decimal('conveyance', 18, 2)->default(0);
            $table->decimal('absent_deduction', 18, 2)->default(0);
            $table->decimal('basic_payable', 18, 2)->default(0);
            $table->decimal('oa_payable', 18, 2)->default(0);
            $table->decimal('gross_payable', 18, 2)->default(0);
            $table->decimal('total_deduction', 18, 2)->default(0);
            $table->decimal('net_payable', 18, 2)->default(0);
            $table->decimal('total_net_payable', 18, 2)->default(0);
            $table->string('remark')->nullable();
            $table->enum('confirm', ['Y', 'N'])->default('N');
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('year');
            $table->index('month');
            $table->index('category');
            $table->index('salary_from_bank');
            $table->index('confirm');

            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->restrictOnDelete();
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->restrictOnDelete();
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->restrictOnDelete();
            $table->foreign('created_by')->references('id')->on('hris_database_employee_basic')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('payroll_tools_process_halfsalary');
    }
};
