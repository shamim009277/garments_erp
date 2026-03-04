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
        if (!Schema::hasTable('om_setup_sample_types')) {
            Schema::create('om_setup_sample_types', function (Blueprint $table) {
                $table->id();
                $table->string('sample_type_code', 20)->unique();
                $table->string('sample_type_name', 100);
                $table->string('sample_type_description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('om_setup_sample_types', function (Blueprint $table) {
                if (!Schema::hasColumn('om_setup_sample_types', 'sample_type_code')) {
                    $table->string('sample_type_code', 20)->unique()->after('id');
                }
                if (!Schema::hasColumn('om_setup_sample_types', 'sample_type_name')) {
                    $table->string('sample_type_name', 100)->after('sample_type_code');
                }
                if (!Schema::hasColumn('om_setup_sample_types', 'sample_type_description')) {
                    $table->string('sample_type_description')->nullable()->after('sample_type_name');
                }
                if (!Schema::hasColumn('om_setup_sample_types', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('sample_type_description');
                }
                if (!Schema::hasColumn('om_setup_sample_types', 'created_by')) {
                    $table->integer('created_by')->nullable()->after('is_active');
                }
                if (!Schema::hasColumn('om_setup_sample_types', 'updated_by')) {
                    $table->integer('updated_by')->nullable()->after('created_by');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop table if it existed before, but for now we can just drop columns if we added them. 
        // Or simplified:
        // Schema::dropIfExists('om_setup_sample_types'); 
        // Since we can't easily know if we created it or updated it, let's just leave down empty or minimal for this fix.
    }
};
