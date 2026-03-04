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
        Schema::create('om_setup_goods_setup_country', function (Blueprint $table) {
            $table->id();

            $table->string('country_name', 100)->unique();
            $table->string('country_code', 20)->nullable();
            $table->boolean('is_active')->default(true);
            //currency
            $table->string('currency', 20)->nullable();
            $table->string('currency_code', 20)->nullable();
            $table->string('currency_symbol', 20)->nullable();
            //exchange rate
            $table->decimal('exchange_rate', 10, 2)->nullable();
            //description
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_setup_goods_setup_country');
    }
};
