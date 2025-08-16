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
        Schema::create('inventory_databases_orders', function (Blueprint $table) {
            // Basic Order Details
            $table->enum('order_type', ['Confirmed', 'Pending', 'Cancelled'])->default('Confirmed');
            $table->enum('compile_type', ['Always Barcode', 'Manual'])->nullable();


            $table->unsignedBigInteger('organization_id');    // Texeurop (BD) Ltd etc.
            $table->unsignedBigInteger('buyer_id'); // buyer_id


            $table->string('style_no')->unique();
            $table->string('style_description')->nullable();
            $table->string('order_no')->unique();
            $table->string('season')->nullable();
            $table->string('fitting_type')->nullable();

            // Basic Order Details
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('merchandiser_id');
            
            $table->unsignedBigInteger('fabric_type_id');
            $table->unsignedBigInteger('composition_id');
            $table->unsignedBigInteger('fabric_treatment_id'); // All Over Print, Yarn Dyed
            $table->unsignedBigInteger('yarn_count_id');
            $table->unsignedBigInteger('yarn_category_id');


            $table->string('gsm')->nullable();
            $table->string('bw_gsm')->nullable();
            $table->decimal('finished_dia', 8, 2)->nullable();
            $table->string('finish_type')->nullable();

            // Print & Embroidery
            $table->string('print_type')->nullable();
            $table->decimal('print_price_per_dzn', 8, 2)->default(0);
            $table->string('embroidery_type')->nullable();
            $table->decimal('embroidery_price_per_dzn', 8, 2)->default(0);
            $table->string('wash_type')->nullable();

            // Pricing & Costing
            $table->decimal('garment_dye_price_per_dzn', 8, 2)->default(0);
            $table->date('order_date');
            $table->decimal('unit_price', 8, 2);
            $table->decimal('cm_price_per_dzn', 8, 2)->default(0);

            // Quantities
            $table->integer('order_quantity');
            $table->decimal('extra_cutting_percent', 5, 2)->default(0);
            $table->boolean('fabric_booking_needed')->default(false);

            // Consumption
            $table->decimal('fabric_consumption_kg_dz', 8, 3)->nullable();
            $table->decimal('kd_allowance_percent', 5, 2)->nullable();
            $table->decimal('cutting_consumption_yards_pcs', 8, 3)->nullable();
            $table->decimal('booking_consumption_yards_pcs', 8, 3)->nullable();

            // Delivery
            $table->string('delivery_mode')->nullable(); // By Sea / Air / Road
            $table->date('delivery_date')->nullable();
            $table->boolean('trims_required_approved')->default(false);
            $table->boolean('closed')->default(false);
            $table->boolean('fabric_from_stock')->default(false);

            // Extra
            $table->text('style_complexity_notes')->nullable();

            //foreign key
            $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->onDelete('restrict');
            $table->foreign('buyer_id')->references('id')->on('inventory_setup_buyer')->onDelete('restrict');
            $table->foreign('product_category_id')->references('id')->on('inventory_setup_product_categories')->onDelete('restrict');
            $table->foreign('merchandiser_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('fabric_type_id')->references('id')->on('inventory_setup_fabric_types')->onDelete('restrict');
            $table->foreign('composition_id')->references('id')->on('inventory_setup_compositions')->onDelete('restrict');
            $table->foreign('fabric_treatment_id')->references('id')->on('inventory_setup_fabric_treatments')->onDelete('restrict');
            $table->foreign('yarn_count_id')->references('id')->on('inventory_setup_yarn_counts')->onDelete('restrict');
            $table->foreign('yarn_category_id')->references('id')->on('inventory_setup_yarn_categories')->onDelete('restrict');

            // Audit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_databases_orders');
    }
};
