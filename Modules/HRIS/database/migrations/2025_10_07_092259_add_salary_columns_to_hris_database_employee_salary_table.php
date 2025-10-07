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
        Schema::table('hris_database_employee_salary', function (Blueprint $table) {
            $table->decimal('old_gross_salary', 18, 2)->default(0)->after('attendance_bonus');
            $table->decimal('old_basic', 18, 2)->default(0)->after('old_gross_salary');
            $table->decimal('old_home_allowance', 18, 2)->default(0)->after('old_basic');
            $table->decimal('old_medical_allowance', 18, 2)->default(0)->after('old_home_allowance');
            $table->decimal('old_food_allowance', 18, 2)->default(0)->after('old_medical_allowance');
            $table->decimal('old_other_allowance', 18, 2)->default(0)->after('old_food_allowance');
            $table->decimal('old_conveyance', 18, 2)->default(0)->after('old_other_allowance');
            $table->decimal('old_attendance_bonus', 18, 2)->default(0)->after('old_conveyance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hris_database_employee_salary', function (Blueprint $table) {
            $table->dropColumn([
                'old_gross_salary',
                'old_basic',
                'old_home_allowance',
                'old_medical_allowance',
                'old_food_allowance',
                'old_other_allowance',
                'old_conveyance',
                'old_attendance_bonus',
            ]);
        });
    }
};
