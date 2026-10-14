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
        Schema::table('ipe_database_new_assessment', function (Blueprint $table) {
            $table->decimal('total_marks', 8, 2)
                  ->default(0)
                  ->after('line');

            $table->decimal('get_marks', 8, 2)
                  ->default(0)
                  ->after('total_marks');

            $table->decimal('efficiency', 5, 2)
                  ->default(0)
                  ->after('get_marks');

            $table->index('total_marks');
            $table->index('get_marks');
            $table->index('efficiency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipe_database_new_assessment', function (Blueprint $table) {
            $table->dropIndex(['total_marks']);
            $table->dropIndex(['get_marks']);
            $table->dropIndex(['efficiency']);

            $table->dropColumn([
                'total_marks',
                'get_marks',
                'efficiency',
            ]);
        });
    }
};
