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
        Schema::table('hris_database_new_applicant', function (Blueprint $table) {
            $table->unsignedBigInteger('org_id')->nullable()->after('id');
            $table->date('birth_date')->nullable()->after('joining_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_new_applicant', function (Blueprint $table) {
            $table->dropColumn('org_id');
            $table->dropColumn('birth_date');
        });
    }
};
