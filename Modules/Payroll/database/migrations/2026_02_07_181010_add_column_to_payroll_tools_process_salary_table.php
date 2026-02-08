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
            $table->decimal('arear_amount', 10, 2)->default(0.00)->after('ot_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_tools_process_salary', function (Blueprint $table) {
            $table->dropColumn('arear_amount');
        });
    }
};
