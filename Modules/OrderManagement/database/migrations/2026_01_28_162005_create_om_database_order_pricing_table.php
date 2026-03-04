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
        Schema::create('om_database_order_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_order_id')->constrained('om_database_initial_order')->onDelete('cascade');
            //from Initial Order
            $table->string('order_code', 20)->unique();
            $table->foreignId('buyer_id')
                ->nullable()
                ->constrained('inventory_setup_buyer')
                ->onDelete('restrict');
            $table->foreignId('organization_id')
                    ->nullable()
                    ->constrained('hris_setup_organizations')
                    ->onDelete('restrict');
            $table->integer('order_quantity')->nullable();
            $table->string('gsm')->nullable();
            $table->string('seasson')->nullable();
             $table->string('style')->nullable();
            $table->string('fabrication')->nullable();
            // Top Section
            $table->foreignId('brand_category_id')
                    ->nullable()
                    ->constrained('om_setup_brand_category')
                    ->onDelete('restrict');
            $table->enum('has_embroidery', ['Y', 'N'])->default('N');
            $table->enum('has_print', ['Y', 'N'])->default('N');
            $table->enum('has_patches', ['Y', 'N'])->default('N');

            $table->integer('no_of_mc_req')->nullable();
            $table->integer('avg_productivity')->nullable();
            $table->decimal('price_per_pcs', 10, 2)->nullable();
            $table->decimal('cad_consumption_kg_dzn', 10, 2)->nullable();

            
            $table->decimal('knitting_dyeing_allowance_percent', 8, 2)->nullable();
            $table->decimal('cutting_wastage_allowance_percent', 8, 2)->nullable();
            $table->decimal('dollar_conversion_rate', 10, 2)->nullable();
             $table->string('file')->nullable();

            // Fabrics Consumption
            // $table->decimal('fabrics_kg_dzn', 10, 4)->nullable();
            // $table->decimal('cutting_kg_dzn', 10, 4)->nullable();
            // $table->decimal('rib_kg_dzn', 10, 4)->nullable();
            // $table->decimal('yarn_kg_dzn', 10, 4)->nullable();
            // $table->decimal('total_fabrics_kg_dzn', 10, 4)->nullable();

            // // Garments Measurement
            // $table->decimal('length', 10, 2)->nullable();
            // $table->decimal('chest', 10, 2)->nullable();
            // $table->decimal('sleeve_length', 10, 2)->nullable();
            // $table->string('fabrics_gsm')->nullable();
            // $table->decimal('rib_consumption_percent', 8, 2)->nullable();

            // // Fabrics Cost Breakup
            // $table->decimal('fabrics_price_kg', 10, 4)->nullable();
            // $table->decimal('knitting_cost_kg', 10, 4)->nullable();
            // $table->decimal('dyeing_cost_kg', 10, 4)->nullable();
            // $table->decimal('yarn_cost_kg', 10, 4)->nullable();
            // $table->decimal('tr_cost_kg', 10, 4)->nullable();

            // // Cost Summary
            // $table->decimal('fabrics_price_dzn', 10, 4)->nullable();
            // $table->decimal('accessories_price_dzn', 10, 4)->nullable();
            // $table->decimal('print_charge_dzn', 10, 4)->nullable();
            // $table->decimal('embroidery_charge_dzn', 10, 4)->nullable();
            // $table->decimal('garment_wash_dzn', 10, 4)->nullable();
            // $table->decimal('cm_dzn', 10, 4)->nullable();
            // $table->decimal('bank_cnf_others_dzn', 10, 4)->nullable();
            // $table->decimal('commercial_cost_dzn', 10, 4)->nullable();
            // $table->decimal('profit_dzn', 10, 4)->nullable();
            // $table->decimal('fob_dzn', 10, 4)->nullable();
            // $table->decimal('fob_pcs', 10, 4)->nullable();

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
        Schema::dropIfExists('om_database_order_pricing');
    }
};
