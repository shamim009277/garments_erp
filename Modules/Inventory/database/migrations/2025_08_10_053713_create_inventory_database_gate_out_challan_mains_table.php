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
        Schema::create('inventory_database_gate_out_challan_mains', function (Blueprint $table) {
            $table->id();
            $table->string('challan_no')->nullable();
            $table->foreignId('org_id')->nullable()->constrained('hris_setup_organizations')->onDelete('restrict');
            $table->foreignId('party_id')->nullable()->constrained('hris_setup_organizations')->onDelete('restrict');
            $table->foreignId('store_id')->nullable()->constrained('inventory_setup_store_locations')->onDelete('restrict');
            $table->foreignId('purpose_id')->nullable()->constrained('inventory_setup_challan_purposes')->onDelete('restrict');
            $table->string('note')->nullable();
            //Date and Time Of Creation
            $table->date('challan_date')->nullable();
            $table->foreignId('challan_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->integer('year')->nullable();
            $table->integer('month')->nullable(); 
            //Status
            $table->tinyInteger('is_done')->default(0);
            $table->foreignId('done_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('done_date')->nullable();
            //Approved
            $table->tinyInteger('is_approved')->default(0);
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('approved_date')->nullable();
            //Rejected
            $table->tinyInteger('is_rejected')->default(0);
            $table->foreignId('rejected_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('rejected_date')->nullable();
            //Received Gate
            $table->tinyInteger('is_gate_out')->default(0);
            $table->foreignId('gate_out_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('gate_out_date')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_database_pur_requisition_mains');
    }
};
