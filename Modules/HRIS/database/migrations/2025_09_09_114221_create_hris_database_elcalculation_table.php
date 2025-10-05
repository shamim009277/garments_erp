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
        Schema::create('hris_database_elcalculation', function (Blueprint $table) {
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
            $table->date('joining_date');
            $table->date('base_date');
            $table->integer('present_days');
            $table->integer('earned_days');
            $table->integer('previous_days');
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
        Schema::dropIfExists('hris_database_elcalculation');
    }
};
