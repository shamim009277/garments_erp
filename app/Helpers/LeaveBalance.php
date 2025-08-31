<?php

namespace App\Helpers;

use Carbon\Carbon;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\LeaveApplication;

class LeaveHelper
{
    public static function getLeaveBalance(int $employeeId, string $leaveType): array
    {
        $today = now();
        $yearStart = $today->copy()->startOfYear();

        $employee = Employee::where('employee_id', $employeeId)
            ->select('id','joining_date')
            ->first();

        if (! $employee) {
            return ['error' => 'Employee not found'];
        }

        $joining  = Carbon::parse($employee->joining_date);

        // ১ বছরের চাকরি পূর্ণ কি না
        $oneYearBeforeYearStart = $yearStart->copy()->subYear();
        $hasOneYearAtYearStart  = $joining->lte($oneYearBeforeYearStart);

        // Window start/end
        $windowStart = $hasOneYearAtYearStart ? $yearStart : $joining;
        $windowEnd   = $today;

        // ===== CL Calculation =====
        if ($leaveType === 'CL') {
            $CL_DAYS_PER_CREDIT = 26;
            $CL_CAP_PER_YEAR    = 14;

            // এখানে Attendance calculation দিলে ভালো হয় (demo values নিচে 0 ধরা হলো)
            $totalMarkedDays = 0;
            $absentDays      = 0;
            $effectiveAttendance = max(0, $totalMarkedDays - $absentDays);

            $earned = intdiv($effectiveAttendance, $CL_DAYS_PER_CREDIT);
            $earned = min($earned, $CL_CAP_PER_YEAR);

            $used = LeaveApplication::where('employee_id', $employee->id)
                ->whereBetween('start_date', [$windowStart, $windowEnd])
                ->whereHas('leaveType', fn($q) => $q->where('code', 'CL'))
                ->sum('days');

            $remaining = max(0, $earned - $used);

            return [
                'type' => 'CL',
                'earned' => $earned,
                'earned_yearly' => $CL_CAP_PER_YEAR,
                'used' => (int) $used,
                'remaining' => $remaining,
            ];
        }

        // ===== SL Calculation =====
        if ($leaveType === 'SL') {
            $SL_ANNUAL_QUOTA = 10;

            $eligibleMonths = self::diffInMonthsInclusive($windowStart, $windowEnd);
            $earned = (int) floor(($eligibleMonths / 12) * $SL_ANNUAL_QUOTA);

            $used = LeaveApplication::where('employee_id', $employee->id)
                ->whereBetween('start_date', [$windowStart, $windowEnd])
                ->whereHas('leaveType', fn($q) => $q->where('code', 'SL'))
                ->sum('days');

            $remaining = max(0, $earned - $used);

            return [
                'type' => 'SL',
                'earned' => $earned,
                'earned_yearly' => $SL_ANNUAL_QUOTA,
                'used' => (int) $used,
                'remaining' => $remaining,
            ];
        }

        return ['error' => 'Invalid leave type'];
    }

    /**
     * Inclusive months between two dates
     */
    private static function diffInMonthsInclusive(Carbon $start, Carbon $end): int
    {
        if ($end->lt($start)) return 0;
        $startMonth = Carbon::create($start->year, $start->month, 1);
        $endMonth   = Carbon::create($end->year, $end->month, 1);
        return $startMonth->diffInMonths($endMonth) + 1;
    }
}
