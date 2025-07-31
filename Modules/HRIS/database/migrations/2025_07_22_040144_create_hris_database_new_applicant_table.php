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
        Schema::create('hris_database_new_applicant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bangla');
            $table->string('mobile')->unique();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedTinyInteger('identification_type')->comment('1 = NID, 2 = Birth Certificate')->default(1);

            $table->string('national_id',17)->unique()->nullable();
            $table->string('birth_certificate_no',30)->unique()->nullable();

            $table->unsignedBigInteger('interviewer_employee_id')->nullable();
            $table->integer('employee_id')->unsigned()->default(0);
            $table->enum('interview_status', ['Pending', 'Selected', 'Disqualify', 'Not Recruit'])->default('Pending');

            $table->date('joining_date')->nullable();
            $table->date('entry_date');
            $table->decimal('proposed_salary', 10, 2)->nullable();
            $table->decimal('determined_salary', 10, 2)->nullable();
            $table->unsignedBigInteger('final_designation_id')->nullable();
            $table->string('remarks')->nullable();

            $table->enum('recruitment_type', ['N', 'R'])->nullable();
            $table->integer('replace_id')->unsigned()->nullable();
            $table->enum('file_entry', ['Y', 'N','C'])->default('N');

            $table->boolean('ipe_assessment_required')->default(false);
            $table->integer('final_status')->default(0)->comment('0 = Pending, 1 = Selected, 2 = Disqualify, 3 = Not Recruit');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->index('interview_status');
            $table->index('file_entry');
            $table->index('final_status');
            $table->index('employee_id');

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('final_designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('interviewer_employee_id')->references('id')->on('hris_database_employee_basic')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_new_applicant');
    }
};
