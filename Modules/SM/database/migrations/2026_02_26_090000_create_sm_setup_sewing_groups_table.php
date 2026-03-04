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
        // Removed sm_setup_sewing_groups creation as user wants to use existing Groups table.
        // We only need the pivot table to link Employees to Groups for Sewing.

        Schema::create('sm_setup_sewing_group_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id'); // Changed from sewing_group_id to group_id to link with sm_setup_groups
            $table->string('employee_id'); 
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('sm_setup_groups')->onDelete('cascade');
            // Removed explicit FK constraint for employee_id due to potential type mismatch issues.
            // But we will add an index for performance.
            $table->index('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_setup_sewing_group_employees');
    }
};
