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
        Schema::create('hris_database_employee_basic', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->char('salaried', 1)->default('Y');
            $table->char('ot_payable', 1)->default('N');
            $table->string('name');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('org_id');
            $table->string('unit')->nullable();
            $table->tinyInteger('line')->default(0);
            $table->tinyInteger('grade')->default(0);

            $table->unsignedBigInteger('mdistrict_id');
            $table->unsignedBigInteger('mthana_id');
            $table->string('mpost_office');
            $table->string('mvillage');

            $table->unsignedBigInteger('pdistrict_id');
            $table->unsignedBigInteger('pthana_id');
            $table->string('ppost_office');
            $table->string('pvillage');

            $table->date('joining_date');
            $table->date('confirmation_date');
            $table->tinyInteger('punch_category')->default(2)->comment('1 = Single Punch, 2 = Double Punch, 3 = No Punch');
            $table->char('refrerence_shift', 1)->default('G');
            $table->date('refrerence_date')->nullable();
            $table->date('mtreturn_date')->nullable();

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();

            $table->date('leaving_date')->nullable();
            $table->char('reason', 1)->default('N');
            $table->string('leaving_note')->nullable();
            $table->string('present_address_duration')->nullable();

            $table->string('photo')->nullable();
            $table->string('signature')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('salaried');
            $table->index('ot_payable');
            $table->index('leaving_date');
            $table->index('reason');

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
            $table->foreign('mdistrict_id')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('mthana_id')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
            $table->foreign('pdistrict_id')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('pthana_id')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_basic');
    }
};
