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
        Schema::create('ipe_setup_quality_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('sl');
            $table->integer('type')->index();
            $table->unsignedBigInteger('department_id');
            $table->string('question')->unique();
            $table->string('question_bn')->index()->unique();
            $table->string('answer')->unique();
            $table->string('answer_bn')->index()->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('hris_setup_departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipe_setup_quality_questions');
    }
};
