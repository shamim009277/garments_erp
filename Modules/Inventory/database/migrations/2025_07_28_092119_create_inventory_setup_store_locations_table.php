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
        Schema::create('inventory_setup_store_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('store_code', 50)->unique();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('country', 100);
            $table->string('store_size', 20)->nullable();
            $table->unsignedBigInteger('store_type_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('owner_id', 50)->nullable();
            $table->string('owner_name', 100)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            // foreign key
            $table->foreign('store_type_id')
                  ->references('id')->on('inventory_setup_storetype')
                  ->onDelete('cascade');
            $table->foreign('organization_id')
                  ->references('id')->on('hris_setup_organizations')
                  ->onDelete('cascade');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_setup_store_locations');
    }
};
