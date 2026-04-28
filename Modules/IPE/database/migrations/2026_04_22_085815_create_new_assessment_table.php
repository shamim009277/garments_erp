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
        Schema::create('ipe_database_new_assessment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('name');
            $table->string('name_bangla');
            $table->string('mobile')->unique();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->date('entry_date');
            $table->unsignedBigInteger('degree_id');
            $table->integer('exp_year')->default(0);
            $table->integer('exp_month')->default(0);
            $table->integer('line')->default(0);

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->index('applicat_id');
            $table->index('designation_id');
            $table->index('line');
            $table->index('org_id');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('applicat_id')->references('id')->on('hris_database_new_applicant')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('hris_setup_degrees')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipe_database_new_assessment');
    }
};
