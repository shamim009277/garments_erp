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
        Schema::table('om_setup_bom_setups', function (Blueprint $table) {
            if (!Schema::hasColumn('om_setup_bom_setups', 'organization_id')) {
                $table->unsignedBigInteger('organization_id')->nullable()->after('buyer_id');
                $table->foreign('organization_id')
                    ->references('id')
                    ->on('hris_setup_organizations')
                    ->onDelete('restrict');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('om_setup_bom_setups', function (Blueprint $table) {
            if (Schema::hasColumn('om_setup_bom_setups', 'organization_id')) {
                $table->dropForeign(['organization_id']);
                $table->dropColumn('organization_id');
            }
        });
    }
};
