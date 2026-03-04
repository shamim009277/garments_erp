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
        Schema::create('om_setup_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_code', 20)->unique();
            $table->string('color_name', 100);
            $table->char('color_hex', 7)->nullable();
            $table->unsignedBigInteger('color_group_id');
            $table->foreign('color_group_id')
                ->references('id')
                ->on('om_setup_color_groups')
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
        Schema::dropIfExists('om_setup_colors');
    }
};
