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
        Schema::create('sm_setup_sewing_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id');
            $table->string('line_incharge_id');
            $table->integer('total_machine');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('line_id')->references('id')->on('sm_setup_lines')->onDelete('cascade');
            // employee_id is a string in hris_database_employee_basic, so index it for lookups
            $table->index('line_incharge_id');
        });

        Schema::create('sm_setup_sewing_line_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sewing_line_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->foreign('sewing_line_id')->references('id')->on('sm_setup_sewing_lines')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('sm_setup_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_setup_sewing_line_groups');
        Schema::dropIfExists('sm_setup_sewing_lines');
    }
};
