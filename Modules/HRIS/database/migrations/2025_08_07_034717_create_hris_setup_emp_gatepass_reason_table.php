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
        Schema::create('hris_setup_emp_gatepass_reason', function (Blueprint $table) {
            $table->id();
            $table->string('reason')->unique();
            $table->unsignedBigInteger('purpose_id');
            $table->integer('reason_for')->default(1)->comment('1=Gatepass, 2=Late Entry, 3=Gatepass & Late Entry');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('reason_for');
            $table->foreign('purpose_id')->references('id')->on('hris_setup_emp_gatepass_purpose')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_setup_emp_gatepass_reason');
    }
};
