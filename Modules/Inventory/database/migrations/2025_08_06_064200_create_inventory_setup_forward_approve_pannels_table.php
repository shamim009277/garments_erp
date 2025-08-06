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
        Schema::create('inventory_setup_forward_approve_pannels', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->tinyInteger('access_level')->default(2)->comment('1 = Forward, 2 = Pricing,3 = Confirmation,4 = Approval,5 = Final Approval');
            $table->foreignId('organization_id')
                    ->nullable()
                    ->constrained('hris_setup_organizations')
                    ->onDelete('restrict');
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('restrict');

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
        Schema::dropIfExists('inventory_setup_forward_approve_pannels');
    }
};
