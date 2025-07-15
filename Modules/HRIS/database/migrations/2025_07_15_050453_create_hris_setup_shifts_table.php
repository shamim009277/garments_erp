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
        Schema::create('hris_setup_shifts', function (Blueprint $table) {
            $table->id();
            $table->char('shift', 1)->unique();
            $table->time('shift_start')->nullable();
            $table->time('shift_end')->nullable();
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->string('break_duration')->nullable();
            $table->tinyInteger('break_duration_type')->nullable()->default(1)->comment('1 = Hour, 2 = Minute');
            $table->tinyInteger('late_after_minutes')->nullable()->default(15);
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_shifts');
    }
};
