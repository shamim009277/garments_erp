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
        Schema::table('om_database_initial_order', function (Blueprint $table) {
            $table->string('file')->nullable()->after('product_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('om_database_initial_order', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
