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
        Schema::create('hris_database_employee_personal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('org_id');
            $table->string('assestment_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedBigInteger('birth_district_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nationality_code')->nullable();
            $table->string('religion_code')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('sex_code')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();

            $table->string('national_id')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->integer('no_of_son')->default(0);
            $table->integer('no_of_daughter')->default(0);
            $table->integer('childern_under_5_years')->default(0);

            $table->string('service_book_no')->nullable();
            $table->date('service_book_date')->nullable();

            $table->string('nominee_nid')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_mobile')->nullable();
            $table->string('relation')->nullable();

            $table->unsignedBigInteger('ndistrict_id')->nullable();
            $table->unsignedBigInteger('nthana_id')->nullable();
            $table->string('npost_office')->nullable();
            $table->string('nvillage')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->index('degree_id');
            $table->index('sex_code');
            $table->index('religion_code');
            $table->index('blood_group');

            $table->foreign('ndistrict_id')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('nthana_id')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
            $table->foreign('birth_district_id')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('hris_setup_degrees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_personal');
    }
};
