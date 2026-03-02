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
        Schema::create('inventory_setup_fabric_treatments', function (Blueprint $table) {
            $table->id();
            $table->string('fabric_treatment_code', 20)->unique(); // Like FT001
            $table->string('fabric_treatment_name', 100);
            $table->string('fabric_treatment_description')->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_fabric_treatments');
    }
};
