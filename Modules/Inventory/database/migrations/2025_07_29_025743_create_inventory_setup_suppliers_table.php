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
        Schema::create('inventory_setup_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_code', 50)->unique();
            $table->string('name', 150)->unique();
            $table->unsignedBigInteger('supplier_type_id');
            $table->string('contact_person', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('trade_license', 100)->nullable();
            $table->string('bank_account', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('swift_code', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            
            //foreign key
            $table->foreign('supplier_type_id')
                ->references('id')->on('inventory_setup_supplier_types')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_suppliers');
    }
};
