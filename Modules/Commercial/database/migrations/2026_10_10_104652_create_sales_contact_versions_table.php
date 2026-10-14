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
        Schema::create('commercial_database_sales_contact_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('sales_contact_id');

            $table->string('version', 30);

            $table->date('date');
            $table->date('revised_date')->nullable();

            $table->unsignedBigInteger('supplier_id');
            $table->text('supplier_address')->nullable();
            $table->text('supplier_bank')->nullable();

            $table->decimal('quantity', 18, 2)->default(0);
            $table->unsignedBigInteger('unit_id');
            $table->decimal('value', 18, 2)->default(0);
            $table->unsignedBigInteger('currency_id');

            $table->unsignedBigInteger('buyer_id');
            $table->decimal('tolerance', 5, 2)->default(0);
            $table->decimal('agent_commission', 8, 4)->default(0);

            $table->unsignedBigInteger('shipment_mode_id')->nullable();
            $table->unsignedBigInteger('payment_terms_id')->nullable();
            $table->unsignedBigInteger('delivery_terms_id')->nullable();

            $table->string('buyer_address', 200)->nullable();
            $table->string('buyer_bank', 300)->nullable();

            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();

            $table->text('additional_terms')->nullable();
            $table->date('expiry_date')->nullable();

            $table->text('consignee_address')->nullable();
            $table->text('consignee_bank')->nullable();
            $table->text('remarks')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('organization_id')->references('id')->on('hris_setup_organizations')->restrictOnDelete();
            $table->foreign('sales_contact_id')->references('id')->on('commercial_database_sales_contacts')->restrictOnDelete();
            $table->foreign('consignee_id')->references('id')->on('hris_setup_buyers')->restrictOnDelete();
            $table->foreign('payment_method_id')->references('id')->on('hris_setup_payment_methods')->restrictOnDelete();
            $table->foreign('shipment_mode_id')->references('id')->on('hris_setup_shipment_modes')->restrictOnDelete();
            $table->foreign('payment_terms_id')->references('id')->on('hris_setup_payment_terms')->restrictOnDelete();
            $table->foreign('delivery_terms_id')->references('id')->on('hris_setup_delivery_terms')->restrictOnDelete();

            // Contract version lookup
            $table->unique(
                ['organization_id', 'sales_contact_id', 'version'],
                'scv_org_contract_version_unique'
            );

            // Organization-wise listing and filtering
            $table->index(
                ['organization_id', 'date', 'id'],
                'scv_org_date_id_idx'
            );

            // Active contracts listing
            $table->index(
                ['organization_id', 'is_active', 'date'],
                'scv_org_active_date_idx'
            );

            // Buyer-wise contract listing
            $table->index(
                ['organization_id', 'buyer_id', 'date'],
                'scv_org_buyer_date_idx'
            );

            // Supplier-wise contract listing
            $table->index(
                ['organization_id', 'supplier_id', 'date'],
                'scv_org_supplier_date_idx'
            );

            // Expiry monitoring
            $table->index(
                ['organization_id', 'expiry_date'],
                'scv_org_expiry_idx'
            );

            // Shipment/payment filtering
            $table->index(
                ['organization_id', 'shipment_mode_id', 'date'],
                'scv_org_shipment_date_idx'
            );

            $table->index(
                ['organization_id', 'payment_terms_id', 'date'],
                'scv_org_payment_date_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_database_sales_contact_versions');
    }
};
