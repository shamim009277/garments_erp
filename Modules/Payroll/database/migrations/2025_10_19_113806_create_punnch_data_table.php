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
        Schema::create('payroll_tools_punch_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('shift',1);
            $table->date('work_date');
            $table->datetime('start_punch')->nullable();
            $table->datetime('end_punch')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->index('org_id');
            $table->index('employee_id');
            $table->index('shift');
            $table->index('work_date');
            $table->index('start_punch');
            $table->index('end_punch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punnch_data');
    }
};
