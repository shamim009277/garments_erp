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
        Schema::table('hris_setup_organizations', function (Blueprint $table) {
            $table->string('address')->nullable()->after('short_name');
            $table->string('email')->nullable()->after('address');
            $table->string('phone', 40)->nullable()->after('email');
            $table->string('icon_name')->nullable()->after('phone');
            $table->string('path')->nullable()->after('icon_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_setup_organizations', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('icon_name');
            $table->dropColumn('path');
        });
    }
};
