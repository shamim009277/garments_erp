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
            $table->string('nfname_bangla')->nullable()->after('nname_bangla');
            $table->string('emergency_fname')->nullable()->after('emergency_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_bangla', function (Blueprint $table) {
            $table->dropColumn('nfname_bangla');
            $table->dropColumn('emergency_fname');
        });
    }
};
