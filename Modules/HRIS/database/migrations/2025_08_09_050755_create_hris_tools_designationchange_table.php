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
            $table->string('employee_id');
            $table->string('designation_id');
            $table->string('organization_id');
            $table->string('department_id');
            $table->string('old_designation_id');
            $table->string('old_department_id');
            $table->string('old_organization_id');
            $table->string('old_employee_id');
            $table->string('new_designation_id');
            $table->string('new_department_id');
            $table->string('new_organization_id');
            $table->string('new_employee_id');
            $table->string('reason');
            $table->string('is_active');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
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
