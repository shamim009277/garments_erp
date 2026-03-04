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
        Schema::create('om_database_order_pricing_accessories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_pricing_id')->constrained('om_database_order_pricing')->onDelete('cascade');
            $table->foreignId('accessory_id')->nullable()->constrained('om_setup_accessories')->onDelete('restrict');
            $table->decimal('value', 12, 4)->nullable();
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
        Schema::dropIfExists('om_database_order_pricing_accessories');
    }
};
