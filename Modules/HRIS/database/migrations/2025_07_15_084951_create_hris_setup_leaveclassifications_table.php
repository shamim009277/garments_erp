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
        Schema::create('hris_setup_leaveclassifications', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('signification')->nullable();
            $table->string('signification_bn')->nullable();
            $table->string('yearly_limit')->nullable();
            $table->string('max_permission')->nullable();
            $table->decimal('pay_ratio', 5, 2)->nullable();
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
        Schema::dropIfExists('hris_setup_leaveclassifications');
    }
};
