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
        Schema::create('hris_database_service_benefits', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('org_id');
            $table->year('year');
            $table->tinyInteger('month');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('line')->default(0);
            $table->unsignedBigInteger('unit')->default(0);
            $table->date('leaving_date');
            $table->date('joining_date');
            $table->integer('paydays');
            $table->decimal('basic', 18, 2)->default(0);
            $table->decimal('rate', 18, 2)->default(0);
            $table->decimal('amount', 18, 2)->default(0);
            $table->decimal('stamp', 18, 2)->default(0);
            $table->decimal('net_payable', 18, 2)->default(0);
            $table->enum('for_pay', ['Y', 'N'])->default('Y');
            $table->enum('status', ['Y', 'N'])->default('N');
            $table->integer('confirm')->default(0);
            $table->char('category', 1);
            $table->char('reason', 1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('leaving_date');
            $table->index('line');
            $table->index('unit');
            $table->index('for_pay');
            $table->index('status');
            $table->index('confirm');

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_service_benefits');
    }
};
