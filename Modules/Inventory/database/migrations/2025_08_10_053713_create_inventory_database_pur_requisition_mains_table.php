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
        Schema::create('inventory_database_pur_requisition_mains', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_no')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained('hris_setup_organizations')->onDelete('restrict');
            $table->foreignId('required_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('store_id')->nullable()->constrained('inventory_setup_store_locations')->onDelete('restrict');
            $table->text('purpose')->nullable();
            $table->string('note')->nullable();
            //Date and Time Of Creation
            $table->date('req_date')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable(); 
            //Status
            $table->tinyInteger('is_done')->default(0);
            //Forward
            $table->tinyInteger('is_forward')->default(0);
            $table->foreignId('forward_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('forward_date')->nullable();
            //Priced
            $table->tinyInteger('is_priced')->default(0);
            $table->foreignId('priced_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('priced_date')->nullable();
            //Confirmed
            $table->tinyInteger('is_confirmed')->default(0);
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('confirmed_date')->nullable();
            //Approved
            $table->tinyInteger('is_approved')->default(0);
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('approved_date')->nullable();
            //Rejected
            $table->tinyInteger('is_rejected')->default(0);
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('rejected_date')->nullable();
            //Final Approved
            $table->tinyInteger('is_fapproved')->default(0);
            $table->foreignId('fapproved_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('fapproved_date')->nullable();
            //Received Gate
            $table->tinyInteger('is_rcv_gate')->default(0);
            $table->foreignId('rcv_gate_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('rcv_gate_date')->nullable();

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
