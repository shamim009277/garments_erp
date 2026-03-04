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
        if (!Schema::hasTable('om_setup_wash_types')) {
            Schema::create('om_setup_wash_types', function (Blueprint $table) {
                $table->id();
                $table->string('wash_type_code', 20)->unique();
                $table->string('wash_type_name', 100);
                $table->string('wash_type_description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_setup_wash_types');
    }
};
