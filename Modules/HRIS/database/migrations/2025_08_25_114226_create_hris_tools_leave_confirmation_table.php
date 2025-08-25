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
        Schema::create('hris_database_leave_confirmation', function (Blueprint $table) {
            $table->id();
            $table->string('leave_id')->unique();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->enum('leave_type_id', ['SL','CL','EL','ML','SPL','LWOP']);
            $table->unsignedBigInteger('reason_id');
            $table->date('application_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days');
            $table->string('remarks', 255)->nullable();
            $table->bigInteger('form_id')->unsigned()->unique();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('form_id');
            $table->index('employee_id');
            $table->index('application_date');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('days');

            $table->foreign('reason_id')->references('id')->on('hris_setup_leavereason')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_tools_leave_confirmation');
    }
};
