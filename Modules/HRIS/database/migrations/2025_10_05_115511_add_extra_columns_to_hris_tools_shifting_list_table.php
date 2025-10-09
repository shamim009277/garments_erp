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
        Schema::table('hris_tools_shifting_list', function (Blueprint $table) {
            $table->unsignedBigInteger('org_id')->nullable()->after('year');

            $table->foreign('org_id')->references('id')->on('hris_setup_organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_tools_shifting_list', function (Blueprint $table) {
            $table->dropColumn('org_id');
            $table->dropForeign(['org_id']);
        });
    }
};
