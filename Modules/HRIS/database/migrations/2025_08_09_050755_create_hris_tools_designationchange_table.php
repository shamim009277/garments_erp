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
        Schema::create('hris_tools_designationchange', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('old_designation_id');
            $table->unsignedBigInteger('old_department_id');
            $table->unsignedBigInteger('old_org_id');

            $table->string('reason');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('old_designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('old_department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('old_org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_tools_designationchange');
    }
};
