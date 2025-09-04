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
        Schema::create('inventory_database_pur_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->integer('pur_req_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('pur_unit_id')->nullable();
            $table->decimal('prev_stock', 8, 2)->nullable();
            $table->decimal('req_qty', 8, 2)->nullable();
            $table->decimal('for_qty', 8, 2)->nullable();
            $table->integer('forward_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('forward_date')->nullable();
            $table->decimal('aprx_priced', 8, 2)->nullable();
            $table->decimal('total_value', 8, 2)->nullable();
            $table->integer('aprx_priced_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('aprx_priced_date')->nullable();
            $table->string('pricing_note', 255)->nullable();
            $table->decimal('app_qty', 8, 2)->nullable();
            $table->integer('approved_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('approved_date')->nullable();
            $table->boolean('is_rejected')->default(0);
            $table->int('rejected_stage')->default(0);
            $table->integer('rejected_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('rejected_date')->nullable();
            $table->char('acc_cleared', 255)->nullable();
            $table->integer('acc_cleared_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('acc_cleared_date')->nullable();
            $table->decimal('final_app_qty', 8, 2)->nullable();
            $table->integer('final_approved_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('final_approved_date')->nullable();
            $table->char('send_to_pur', 255)->nullable();
            $table->integer('send_to_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('send_to_date')->nullable();
            $table->text('note')->nullable();
            $table->char('received_gate', 255)->nullable();
            $table->decimal('rcv_gate_qty', 8, 2)->nullable();
            $table->integer('received_gate_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('received_gate_date')->nullable();
            $table->decimal('rcv_qty', 8, 2)->nullable();
            $table->integer('received_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('received_date')->nullable();
            $table->char('done', 255)->nullable();
            $table->char('purchased', 255)->nullable();
            $table->decimal('pur_qty', 8, 2)->nullable();
            $table->decimal('pur_price', 8, 2)->nullable();
            $table->integer('purchase_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('purchase_date')->nullable();
            $table->integer('who_purcahsed')->nullable();
            $table->string('remarks', 255)->nullable();
            $table->string('comment', 255)->nullable();
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
        Schema::dropIfExists('inventory_database_pur_requisition_details');
    }
};
