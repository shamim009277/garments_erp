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
        Schema::create('hris_database_employee_bangla', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('name_bangla');
            $table->string('fname_bangla');
            $table->string('mname_bangla');
            $table->string('nname_bangla');
            $table->string('relation_bangla');
            $table->string('national_id_bangla')->nullable();

            $table->unsignedBigInteger('mdistrict_id_bangla');
            $table->unsignedBigInteger('mthana_id_bangla');
            $table->string('mpost_office_bangla');
            $table->string('mvillage_bangla');

            $table->unsignedBigInteger('pdistrict_id_bangla');
            $table->unsignedBigInteger('pthana_id_bangla');
            $table->string('ppost_office_bangla');
            $table->string('pvillage_bangla');

            $table->unsignedBigInteger('ndistrict_id_bangla')->nullable();
            $table->unsignedBigInteger('nthana_id_bangla')->nullable();
            $table->string('npost_office_bangla')->nullable();
            $table->string('nvillage_bangla')->nullable();

            $table->string('identification')->nullable();
            $table->string('conduct')->nullable();
            $table->string('spouse_name_bangla')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->useCurrent();
            $table->unsignedBigInteger('updated_by')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->index('employee_id');
            $table->foreign('mdistrict_id_bangla')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('mthana_id_bangla')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
            $table->foreign('pdistrict_id_bangla')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('pthana_id_bangla')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
            $table->foreign('ndistrict_id_bangla')->references('id')->on('hris_setup_districts')->onDelete('cascade');
            $table->foreign('nthana_id_bangla')->references('id')->on('hris_setup_thanas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hris_database_employee_bangla');
    }
};
