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
        Schema::create('hris_tools_calender', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->year('year');
            $table->tinyInteger('month');
            $table->enum('holiday', ['Y', 'N']);
            $table->enum('public_holiday', ['Y', 'N']);
            $table->string('note');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();

            $table->index('date');
            $table->index('year');
            $table->index('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_tools_calender');
    }
};
