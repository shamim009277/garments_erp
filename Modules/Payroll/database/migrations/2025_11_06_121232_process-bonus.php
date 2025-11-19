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
        Schema::create('payroll_tools_process_bonus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('bonus_type');
            $table->date('base_date');
            $table->unsignedBigInteger('year');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line')->nullable();
            $table->unsignedBigInteger('unit')->nullable();
            $table->char('category', 1);
            $table->date('leaving_date')->nullable();
            $table->date('joining_date')->nullable();
            $table->decimal('gross_salary', 18, 2)->default(0);
            $table->decimal('basic', 18, 2)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->enum('confirm', ['Y', 'N'])->default('N');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->index('org_id');
            $table->index('employee_id');
            $table->index('year');
            $table->index('category');
            $table->index('bonus_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('payroll_tools_process_bonus');
    }
};
