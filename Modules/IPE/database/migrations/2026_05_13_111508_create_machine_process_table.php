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
        Schema::create('ipe_setup_machine_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->integer('process_type')->index()->comment('1=Basic, 2=Semicritical, 3=Critical');
            $table->string('process')->index();
            $table->string('process_code')->unique()->index();
            $table->string('process_name')->index();
            $table->string('process_name_bn')->index();
            $table->string('item');
            $table->integer('capacity')->default(0);
            $table->decimal('time', 8, 3)->default(0);

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('ipe_setup_machine_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipe_setup_machine_processes');
    }
};
