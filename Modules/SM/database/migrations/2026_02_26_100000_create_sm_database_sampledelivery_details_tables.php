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
          Schema::create('sm_database_sampledelivery_details', function (Blueprint $table) {
            $table->id();
            $table->integer('ChallanID');
            $table->integer('ProgrammeID');
            $table->unsignedBigInteger('ProductionID');
            $table->string('Color', 30);
            $table->string('size', 30);
            $table->integer('Quantity');
            $table->string('Comments', 100);
            $table->integer('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_database_sampledelivery_details');
    }
};
