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
        Schema::create('payroll_database_advance', function (Blueprint $table) {
            $table->id();
            $table->string('advance_id')->unique();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line_id');
            $table->unsignedBigInteger('unit_id');
            $table->date('issue_date');
            $table->date('refund_start_date');
            $table->decimal('advance_amount', 18, 2);
            $table->decimal('installment_size', 18, 2);
            $table->decimal('balance_amount', 18, 2)->default(0);
            $table->decimal('refund_amount', 18, 2)->default(0);
            $table->enum('full_refund', ['Y', 'N'])->default('N');
            $table->string('reason');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('advance_id');
            $table->index('line_id');
            $table->index('unit_id');
            $table->index('full_refund');

            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->restrictOnDelete();
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->restrictOnDelete();
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_database_advance');
    }
};
