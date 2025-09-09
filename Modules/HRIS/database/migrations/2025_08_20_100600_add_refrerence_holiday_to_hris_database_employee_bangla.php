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
        Schema::table('hris_database_employee_bangla', function (Blueprint $table) {
            $table->string('emergency_name', 100)->nullable()->after('spouse_name_bangla');
            $table->string('emergency_relation', 50)->nullable()->after('emergency_name');
            $table->string('emergency_address', 255)->nullable()->after('emergency_relation');
            $table->string('emergency_mobile', 11)->nullable()->after('emergency_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_bangla', function (Blueprint $table) {
            $table->dropColumn('emergency_name');
            $table->dropColumn('emergency_relation');
            $table->dropColumn('emergency_address');
            $table->dropColumn('emergency_mobile');
        });
    }
};
