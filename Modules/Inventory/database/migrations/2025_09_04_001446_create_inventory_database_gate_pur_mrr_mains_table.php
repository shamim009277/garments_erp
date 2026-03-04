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
        Schema::create('inventory_database_gate_pur_mrr_mains', function (Blueprint $table) {
            $table->id();
            $table->string('mrr_no');
            $table->date('mrr_date');
            $table->foreignId('organization_id')->nullable()->constrained('hris_setup_organizations')->onDelete('restrict');
            $table->foreignId('gate_entry_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('received_by_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained('inventory_setup_suppliers')->onDelete('restrict');
            $table->string('note')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable(); 
            $table->string('act_challan_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('driver_name')->nullable();
            $table->text('document')->nullable();

            $table->decimal('bill_amount', 8, 2)->default(0);
            $table->decimal('paid_amount', 8, 2)->default(0);
            $table->decimal('due_amount', 8, 2)->default(0);

            $table->tinyInteger('is_done')->default(0);
            $table->foreignId('done_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('done_date')->nullable();

            $table->tinyInteger('is_qa_checked')->default(0);
            $table->foreignId('qa_checked_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('qa_checked_date')->nullable();
            $table->tinyInteger('qa_stage')->default(0);

            
            $table->tinyInteger('is_store_rcv')->default(0);
            $table->foreignId('store_rcv_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('store_rcv_date')->nullable();

            $table->tinyInteger('is_audit_chck')->default(0);
            $table->foreignId('audit_chck_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('audit_chck_date')->nullable();

            $table->char('is_returned', 1)->default('N');
            $table->foreignId('returned_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('returned_date')->nullable();

            $table->tinyInteger('is_bill_paid')->default(0);
            $table->foreignId('bill_paid_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->date('bill_paid_date')->nullable();

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
        Schema::dropIfExists('inventory_database_gate_pur_mrr_mains');
    }
};
