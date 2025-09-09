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
        Schema::create('hris_database_employee_increments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->integer('line')->default(0);
            $table->integer('unit')->default(0);
            $table->unsignedBigInteger('new_department_id');
            $table->unsignedBigInteger('new_designation_id');
            $table->double('gross_salary',18,2)->default(0);
            $table->double('basic',18,2)->default(0);
            $table->double('medical_allowance',18,2)->default(0);
            $table->double('home_allowance',18,2)->default(0);
            $table->double('food_allowance',18,2)->default(0);
            $table->double('conveyance',18,2)->default(0);
            $table->date('increment_date');
            $table->date('effective_date');
            $table->date('arrear_upto_date');
            $table->unsignedBigInteger('increment_type_id')->default(0);
            $table->enum('increment_source', ['B', 'G']);
            $table->enum('increment_value_type', ['P', 'F']);
            $table->decimal('increment_value',18,2);
            $table->decimal('amount', 18, 2);
            $table->decimal('house_rent_basic', 18, 2);
            $table->integer('enforce')->default(0);
            $table->text('remarks')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('increment_date');
            $table->index('effective_date');
            $table->index('arrear_upto_date')->nullable();
            $table->index('increment_source');
            $table->index('increment_value');
            $table->index('enforce');

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('new_department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('new_designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('increment_type_id')->references('id')->on('hris_setup_increment_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_increments');
    }
};
