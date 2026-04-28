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
        Schema::create('ipe_setup_process', function (Blueprint $table) {
            $table->id();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipe_setup_process');
    }
};
