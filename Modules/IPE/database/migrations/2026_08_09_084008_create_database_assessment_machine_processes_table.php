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
        Schema::create('ipe_database_assessment_machine_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id');
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('machine_id');

            $table->integer('declare')->default(0);
            $table->integer('cycle_one')->default(0);
            $table->integer('cycle_two')->default(0);
            $table->integer('cycle_three')->default(0);
            $table->integer('cycle_four')->default(0);
            $table->integer('cycle_five')->default(0);

            $table->integer('average')->default(0);
            $table->decimal('smv', 8, 3)->default(0);
            $table->decimal('target', 8, 3)->default(0);
            $table->decimal('efficiency', 8, 3)->default(0);

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->unique(['assessment_id', 'process_id'], 'assess_process_unique');

            $table->foreign('assessment_id')
                ->references('id')->on('ipe_database_new_assessment')
                ->onDelete('cascade');

            $table->foreign('process_id')
                ->references('id')->on('ipe_setup_machine_processes')
                ->onDelete('cascade');

            $table->foreign('machine_id')
                ->references('id')->on('ipe_setup_machine_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipe_database_assessment_machine_processes');
    }
};
