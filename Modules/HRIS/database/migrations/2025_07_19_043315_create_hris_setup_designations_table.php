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
        Schema::create('hris_setup_designations', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 100)->unique();
            $table->string('designation_bn', 100)->nullable();
            $table->unsignedBigInteger('parent_designation_id');
            $table->char('category_code', 1);
            $table->char('is_attn_bonus', 1)->default('N');
            $table->decimal('attendance_bonus', 18, 2)->default(0);
            $table->decimal('tiffin_bill', 18, 2)->default(0);
            $table->decimal('night_bill1', 18, 2)->default(0);
            $table->decimal('night_bill2', 18, 2)->default(0);
            $table->decimal('night_bill3', 18, 2)->default(0);
            $table->decimal('min_gross', 18, 2)->default(0);
            $table->decimal('max_gross', 18, 2)->default(0);
            $table->integer('grade')->default(0);
            $table->integer('approved_mp')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->index('category_code');
            $table->index('is_attn_bonus');
            $table->foreign('parent_designation_id')->references('id')->on('hris_setup_parent_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_designations');
    }
};
