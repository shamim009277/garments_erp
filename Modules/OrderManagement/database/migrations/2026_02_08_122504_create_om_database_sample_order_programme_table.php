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
        Schema::create('om_database_sample_order_programme', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_order_id')->constrained('om_database_initial_order')->onDelete('cascade');
            $table->string('programme_code', 20)->unique();
            $table->string('fab_src')->nullable();
            $table->foreignId('color_id')->nullable()->constrained('inventory_setup_colors')->onDelete('set null');
            $table->foreignId('sample_type_id')->nullable()->constrained('inventory_setup_sample_types')->onDelete('set null');
            $table->foreignId('composition_id')->nullable()->constrained('inventory_setup_compositions')->onDelete('set null');
            $table->foreign('size_id')
                  ->references('id')
                  ->on('inventory_setup_size')
                  ->onDelete('set null');
            $table->string('trims_fabric')->nullable();
            $table->string('wash_type')->nullable();
            $table->string('style_no')->nullable();
            $table->foreignId('item_id')->nullable()->constrained('inventory_setup_product_categories')->onDelete('set null');
            $table->string('f_dia')->nullable();
            $table->string('gsm')->nullable();
            $table->decimal('fin_fab_kg', 12, 4)->nullable();
            $table->integer('qty_pcs')->nullable();
            $table->foreignId('fabric_treatment_id')->nullable()->constrained('inventory_setup_fabric_treatments')->onDelete('set null');
            $table->text('print_emb_inst')->nullable();
            $table->foreignId('size_id')->nullable()->constrained('om_setup_size')->onDelete('set null');
            $table->date('delivery_deadline')->nullable();
            $table->text('tri_acr')->nullable();
            $table->date('tri_acr_deadline')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('om_database_sample_order_programme');
    }
};
