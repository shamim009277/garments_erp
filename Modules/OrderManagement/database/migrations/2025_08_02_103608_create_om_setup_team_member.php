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
        Schema::create('om_setup_team_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')
                    ->nullable()
                    ->constrained('om_setup_team')
                    ->onDelete('restrict');
            $table->foreignId('merchant_id')
                    ->nullable()
                    ->constrained('hris_database_employee_basic')
                    ->onDelete('restrict');
            $table->boolean('is_leader')->default(false);
            $table->boolean('is_assistant')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_setup_team_member');
    }
};
