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
        Schema::table('payroll_tools_process_bonus', function (Blueprint $table) {
            //Add extra columns
            $table->integer('month')->after('year')->default(0);
            $table->decimal('percentage', 5, 2)->after('amount')->default(0.00);

            $table->index(['month','amount','confirm']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_tools_process_bonus', function (Blueprint $table) {
            //Remove extra columns
            $table->dropIndex(['month','amount','confirm']);
            $table->dropColumn(['month','percentage']);
        });
    }
};
