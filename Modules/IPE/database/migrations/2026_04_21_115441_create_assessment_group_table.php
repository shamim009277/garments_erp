<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ipe_setup_assessment_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('code')->index();
            $table->unsignedBigInteger('designation_id');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->foreign('designation_id')->references('id')->on('hris_setup_designations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ipe_setup_assessment_groups');
    }
};
