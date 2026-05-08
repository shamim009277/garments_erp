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
        Schema::table('ipe_database_new_assessment', function (Blueprint $table) {
            $table->string('assessment_date')->after('applicant_id');
            $table->boolean('is_done')->after('line')->default(0);

            $table->index('is_done');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipe_database_new_assessment', function (Blueprint $table) {
            $table->dropColumn(['assessment_date', 'is_done']);
        });
    }
};
