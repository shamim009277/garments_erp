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
        Schema::create('commercial_database_sales_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('contact_no', 20)->unique()->index();
            $table->date('date')->index();
            $table->boolean('is_active')->default(true);
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();

            $table->foreignId('organization_id')->constrained('hris_setup_organizations')->restrictOnDelete();

            $table->unique(
                ['organization_id', 'contact_no'],
                'sc_org_contact_no_uq'
            );

            $table->index(
                ['organization_id', 'status', 'id'],
                'sc_org_status_id_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_database_sales_contacts');
    }
};
