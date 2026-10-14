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
            $table->string('nominee_fname')->nullable()->after('nominee_name');
            $table->date('nbirth_date')->nullable()->after('nominee_fname');
            $table->string('emergency_fname')->nullable()->after('emergency_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_personal', function (Blueprint $table) {
            $table->dropColumn('nominee_fname');
            $table->dropColumn('nbirth_date');
            $table->dropColumn('emergency_fname');
        });
    }
};
