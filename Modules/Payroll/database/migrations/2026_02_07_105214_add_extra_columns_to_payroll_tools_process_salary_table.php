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
        Schema::table('payroll_tools_process_salary', function (Blueprint $table) {
            $table->integer('late_days')->default(0)->after('leave_days');
            $table->integer('weekend_days')->default(0)->after('late_days');
            $table->integer('general_holiday_days')->default(0)->after('weekend_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_tools_process_salary', function (Blueprint $table) {
            $table->dropColumn('late_days');
            $table->dropColumn('weekend_days');
            $table->dropColumn('general_holiday_days');
        });
    }
};
