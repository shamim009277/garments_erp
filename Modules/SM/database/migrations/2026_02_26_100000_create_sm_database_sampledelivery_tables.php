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
        Schema::create('sm_database_sampledelivery', function (Blueprint $table) {
            $table->id();
            $table->string('ChallanNo', 30);
            $table->date('Date');
            $table->integer('BuyerID');
            $table->integer('EmployeeID');
            $table->integer('ChallanType')->comment('1=Returnable,2=Non-Returnable,3=Export');
            $table->integer('GoodsType')->comment('1=Gray Fabric,2=Complete Body');
            $table->string('Comments', 100)->nullable();
            $table->char('C4S', 1);
            $table->integer('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_database_sampledelivery');
    }
};
