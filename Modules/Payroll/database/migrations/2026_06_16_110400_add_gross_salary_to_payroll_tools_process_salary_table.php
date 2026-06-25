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
            $table->decimal('gross_salary', 18, 2)->default(0)->after('wrh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_tools_process_salary', function (Blueprint $table) {
            $table->dropColumn('gross_salary');
        });
    }
};
