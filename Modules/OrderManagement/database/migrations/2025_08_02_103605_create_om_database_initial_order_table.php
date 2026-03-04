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
        Schema::create('om_database_initial_order', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 20)->unique();
            $table->foreignId('buyer_id')
                ->nullable()
                ->constrained('inventory_setup_buyer')
                ->onDelete('restrict');
            $table->text('description')->nullable();
            $table->foreignId('organization_id')
                    ->nullable()
                    ->constrained('hris_setup_organizations')
                    ->onDelete('restrict');
            $table->integer('order_quantity')->nullable();
            $table->string('style')->nullable();
            $table->string('gsm')->nullable();
            $table->string('po')->nullable();
            $table->string('seasson')->nullable();
            $table->string('fabrication')->nullable();
            $table->string('finish_type')->nullable();
            $table->text('instructions')->nullable();
            $table->foreignId('color_id')
                    ->nullable()
                    ->constrained('inventory_setup_colors')
                    ->onDelete('restrict');
            $table->foreignId('size_id')
                    ->nullable()
                    ->constrained('inventory_setup_size')
                    ->onDelete('restrict');
            $table->foreignId('order_type_id')
                    ->nullable()
                    ->constrained('om_setup_order_type')
                    ->onDelete('restrict');
             $table->foreignId('merchant_id')
                    ->nullable()
                    ->constrained('hris_database_employee_basic')
                    ->onDelete('restrict');
             $table->foreignId('yarn_count_id')
                    ->nullable()
                    ->constrained('inventory_setup_yarn_counts')
                    ->onDelete('restrict');

             $table->foreignId('product_category_id')
                    ->nullable()
                    ->constrained('inventory_setup_product_categories')
                    ->onDelete('restrict');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('om_database_initial_order');
    }
};
