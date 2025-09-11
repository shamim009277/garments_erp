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
        Schema::create('hris_database_elpayment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line')->default(0);
            $table->unsignedBigInteger('unit')->default(0);
            $table->string('category');
            $table->unsignedBigInteger('month');
            $table->unsignedBigInteger('year');
            $table->char('reason', 1)->default('N')->comment('N = Normal, L = Long Absence, D = Death, R = Resignation, M = Maternity');
            $table->date('joining_date');
            $table->date('base_date');
            $table->date('leaving_date')->nullable();
            $table->integer('pay_days');
            $table->decimal('gross_salary', 18, 2);
            $table->decimal('basic', 18, 2);
            $table->decimal('rate', 18, 2);
            $table->decimal('amount', 18, 2);
            $table->enum('confirm', ['Y', 'N'])->default('N');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('month');
            $table->index('year');
            $table->index('base_date');
            $table->index('category');
            $table->index('confirm');

            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_elpayment');
    }
};
