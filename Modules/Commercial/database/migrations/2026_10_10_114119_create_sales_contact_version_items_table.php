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
        Schema::create('commercial_database_sales_contact_version_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('version_id');

            $table->string('po_no', 100);
            $table->string('style_no', 100);
            $table->string('item_name', 150);
            $table->string('fabric_name', 200)->nullable();

            $table->decimal('quantity', 18, 4)->default(0);
            $table->decimal('price', 18, 4)->default(0);
            $table->date('shipment_date')->nullable();

            // Active item or removed item in this revision
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->foreign('version_id')
                ->references('id')
                ->on('commercial_database_sales_contact_versions')
                ->onDelete('restrict');

            // Indexes for filtering and reporting
            $table->index(['version_id', 'is_active', 'id'], 'scvi_version_active_idx');
            $table->index(['version_id', 'po_no'], 'scvi_version_po_idx');
            $table->index(['version_id', 'style_no'], 'scvi_version_style_idx');
            $table->index('shipment_date', 'scvi_shipment_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_database_sales_contact_version_items');
    }
};
