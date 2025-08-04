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
        Schema::create('inventory_setup_buyer', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_code', 20)->unique(); // Like BY001
            $table->string('buyer_name', 100);
            $table->enum('buyer_type', ['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller'])->default('Local');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('fax', 30)->nullable();
            $table->text('address')->nullable();
            // $table->bigInteger('country_id')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_active')->default(true);

            // //foreign key
            // $table->foreign('country_id')
            //     ->references('id')
            //     ->on('inventory_setup_goods_setup_country')
            //     ->onDelete('restrict');
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('inventory_setup_goods_setup_country')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_buyer');
    }
};
