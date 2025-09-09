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
        Schema::table('hris_database_employee_personal', function (Blueprint $table) {
            $table->string('emergency_name', 100)->nullable();
            $table->string('emergency_relation', 50)->nullable();
            $table->string('emergency_address', 255)->nullable();
            $table->string('emergency_mobile', 11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_personal', function (Blueprint $table) {
            $table->dropColumn(['emergency_name', 'emergency_relation', 'emergency_address', 'emergency_mobile']);
        });
    }
};
