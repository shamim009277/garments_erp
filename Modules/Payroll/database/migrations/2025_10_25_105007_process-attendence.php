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
        Schema::create('payroll_tools_process_attendence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('shift',1);
            $table->date('work_date');
            $table->datetime('start_punch')->default(null);
            $table->datetime('end_punch')->default(null);
            $table->integer('rwh')->default(0);
            $table->integer('wwh')->default(8);
            $table->integer('ot_hours')->default(0);
            $table->integer('ot_minutes')->default(0);
            $table->integer('total_hours')->default(0);
            $table->enum('attn_type', ['AB', 'PR', 'HD', 'SL', 'CL', 'EL', 'ML', 'SPL', 'LWOP'])->default(null);
            $table->enum('is_late', ['Y', 'N'])->default('N');
            $table->integer('late_minutes')->default(0);
            $table->integer('short_minutes')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->index('org_id');
            $table->index('employee_id');
            $table->index('work_date');
            $table->index('shift');
            $table->index('attn_type');
            $table->index('start_punch');
            $table->index('end_punch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_tools_process_attendence');
    }
};
