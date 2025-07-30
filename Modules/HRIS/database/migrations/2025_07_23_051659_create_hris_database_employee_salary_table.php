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
        Schema::create('hris_database_employee_salary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('org_id');
            $table->decimal('gross_salary', 18, 2);
            $table->decimal('basic', 18, 2);
            $table->decimal('home_allowance', 18, 2)->default(0);
            $table->decimal('medical_allowance', 18, 2)->default(0);
            $table->decimal('food_allowance', 18, 2)->default(0);
            $table->decimal('other_allowance', 18, 2)->default(0);
            $table->decimal('conveyance', 18, 2)->default(0);
            $table->decimal('attendance_bonus', 18, 2)->default(0);

            $table->char('ot_payable', 1)->default('N');
            $table->decimal('ot_rate', 18, 2)->default(0);
            $table->char('holiday_allowance', 1)->default('N');
            $table->char('salary_from_bank', 1)->default('N');

            $table->string('account_no')->nullable();
            $table->string('mobile_banking')->nullable();
            $table->string('bank_name')->nullable();

            $table->char('pf_member', 1)->default('N');
            $table->date('pf_member_date')->nullable();
            $table->date('pf_close_date')->nullable();

            $table->string('tin_no')->nullable();
            $table->decimal('tax', 18, 2)->default(0);
            $table->decimal('pf', 18, 2)->default(0);

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('ot_payable');

            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_salary');
    }
};
