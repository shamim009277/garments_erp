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
        Schema::table('hris_database_employee_basic', function (Blueprint $table) {
            $table->string('refrerence_holiday')->nullable();
            $table->index('refrerence_holiday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_basic', function (Blueprint $table) {
            $table->dropColumn('refrerence_holiday');
        });
    }
};
