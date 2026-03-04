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
        Schema::create('om_setup_buyer_merchant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')
                    ->nullable()
                    ->constrained('inventory_setup_buyer')
                    ->onDelete('restrict');
            $table->foreignId('merchant_id')
                    ->nullable()
                    ->constrained('hris_database_employee_basic')
                    ->onDelete('restrict');
            $table->foreignId('organization_id')
                    ->nullable()
                    ->constrained('hris_setup_organizations')
                    ->onDelete('restrict');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_setup_buyer_merchant');
    }
};
