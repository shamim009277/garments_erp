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
        Schema::table('om_database_sample_order_programme', function (Blueprint $table) {
            // Drop the incorrect foreign key constraint
            $table->dropForeign(['size_id']);
            
            // Add the correct foreign key constraint referencing inventory_setup_size
            $table->foreign('size_id')
                  ->references('id')
                  ->on('inventory_setup_size')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('om_database_sample_order_programme', function (Blueprint $table) {
            // Revert changes
            $table->dropForeign(['size_id']);
            
            $table->foreign('size_id')
                  ->references('id')
                  ->on('om_setup_size')
                  ->onDelete('set null');
        });
    }
};
