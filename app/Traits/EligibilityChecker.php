<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait EligibilityChecker
{
    public function checkEligibility(int $userId, int $employeeId,string $context, ?int $type = null): bool
    {
        switch ($context) {
            case 'gatepass':
                return $this->checkGatepassEligibility($userId, $employeeId);

            case 'leave':
                return $this->checkLeaveEligibility($userId, $employeeId,$type);

            default:
                return false;
        }
    }

    public function checkGatepassEligibility(int $userId, int $employeeId): bool
    {
        return DB::table('hris_settings_employee_gatepass_approve')
            ->where('user_id', $userId)
            ->where('employee_id', $employeeId)
            ->exists();
    }

    public function checkLeaveEligibility(int $userId, int $employeeId, ?int $type = null): bool
    {
        return DB::table('hris_settings_employee_leave_forwardapprove')
            ->where('user_id', $userId)
            ->where('employee_id', $employeeId)
            ->where('type', $type)
            ->exists();
    }
}
