<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payroll_tools_process_attendence', function (Blueprint $table) {
            $table->index(['org_id', 'work_date', 'attn_type'], 'idx_pa_org_date_type');
            $table->index(['work_date', 'employee_id'], 'idx_pa_date_emp');
        });
    }

    public function down(): void
    {
        Schema::table('payroll_tools_process_attendence', function (Blueprint $table) {
            try { $table->dropIndex('idx_pa_org_date_type'); } catch (\Throwable $e) { }
            try { $table->dropIndex('idx_pa_date_emp'); }     catch (\Throwable $e) { }
        });
    }
};
