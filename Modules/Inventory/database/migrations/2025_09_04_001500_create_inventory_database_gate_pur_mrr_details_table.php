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
        Schema::create('inventory_database_gate_pur_mrr_details', function (Blueprint $table) {
            $table->id();
            $table->integer('mrr_id')->nullable();
            $table->integer('req_main_id')->nullable();
            $table->integer('req_detail_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('req_unit_id')->nullable();
            $table->decimal('req_qty', 8, 2)->nullable();
            $table->decimal('received_qty', 8, 2)->nullable();
            $table->decimal('return_qty', 8, 2)->nullable();
            $table->decimal('store_rcv_qty', 8, 2)->nullable();
            $table->decimal('check_qty', 8, 2)->nullable();
            $table->decimal('pass_qty', 8, 2)->nullable();
            $table->decimal('req_price', 8, 2)->nullable();
            $table->decimal('pur_price', 8, 2)->nullable();
            $table->decimal('req_amount', 8, 2)->default(0);
            $table->decimal('pur_amount', 8, 2)->default(0);
            $table->string('note', 255)->nullable();
            $table->string('remarks', 255)->nullable();

            $table->tinyInteger('is_store_rcv')->default(0);
            $table->integer('store_rcv_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('store_rcv_date')->nullable();

            $table->tinyInteger('is_qa_pass')->default(0);
            $table->integer('qa_check_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->dateTime('qa_check_date')->nullable();
           
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
        Schema::dropIfExists('inventory_database_gate_pur_mrr_details');
    }
};
