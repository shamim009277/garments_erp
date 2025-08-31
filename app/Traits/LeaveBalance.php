<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\LeaveApplication;
use Modules\HRIS\Models\Database\LeaveConfirmation;

trait LeaveBalance
{
    public function calculateAccrualUpToToday(int $employeeId): array
    {
        $today = now();
        $yearStart = $today->copy()->startOfYear();

        $employee = Employee::where('employee_id', $employeeId)->select('id','joining_date')->first();
        $joining  = Carbon::parse($employee->joining_date);

        // ১ বছরের চাকরি পূর্ণ কি না
        $oneYearBeforeYearStart = $yearStart->copy()->subYear();
        $hasOneYearAtYearStart = $joining->lte($oneYearBeforeYearStart);

        // Window start
        $windowStart = $hasOneYearAtYearStart ? $yearStart : $joining;
        $windowEnd   = $today;

        // ===== CL Calculation =====
        // $totalMarkedDays = Attendance::where('employee_id', $employeeId)
        //     ->whereBetween('date', [$windowStart, $windowEnd])
        //     ->count();

        // $absentDays = Attendance::where('employee_id', $employeeId)
        //     ->whereBetween('date', [$windowStart, $windowEnd])
        //     ->where('status', 'absent')
        //     ->count();

        $totalMarkedDays = 0;
        $absentDays = 0;

        $effectiveAttendance = max(0, $totalMarkedDays - $absentDays);

        $CL_DAYS_PER_CREDIT = 26;
        $CL_CAP_PER_YEAR    = 14;

        $clEarned = intdiv($effectiveAttendance, $CL_DAYS_PER_CREDIT);
        //$clEarned = min($clEarned, $CL_CAP_PER_YEAR);

        $clUsed = LeaveApplication::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'CL'))
            ->sum('days');

        $clActualUsed = LeaveConfirmation::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'CL'))
            ->sum('days');

        $clRemaining = max(0, $clEarned - $clUsed);
        $clActualRemaining = max(0, $clEarned - $clActualUsed);

        // ===== SL Calculation =====
        $SL_ANNUAL_QUOTA = 10;

        $eligibleMonths = $this->diffInMonthsInclusive($windowStart, $windowEnd);
        $slEarned = (int) floor(($eligibleMonths / 12) * $SL_ANNUAL_QUOTA);

        $slUsed = LeaveApplication::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'SL'))
            ->sum('days');

        $slActualUsed = LeaveConfirmation::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'SL'))
            ->sum('days');

        $slRemaining = max(0, $slEarned - $slUsed);
        $slActualRemaining = max(0, $slEarned - $slActualUsed);

        return [
            'window' => [
                'start' => $windowStart->toDateString(),
                'end'   => $windowEnd->toDateString(),
            ],
            'CL' => [
                'earned' => $clEarned,
                'earned_yearly' => 14,
                'used' => (int) $clUsed,
                'actual_used' => (int) $clActualUsed,
                'remaining' => $clRemaining,
                'actual_remaining' => $clActualRemaining,
            ],
            'SL' => [
                'earned' => $slEarned,
                'earned_yearly' => 10,
                'used' => (int) $slUsed,
                'actual_used' => (int) $slActualUsed,
                'remaining' => $slRemaining,
                'actual_remaining' => $slActualRemaining,
            ],
        ];
    }

    /**
     * Inclusive months between two dates
     */
    private function diffInMonthsInclusive(Carbon $start, Carbon $end): int
    {
        if ($end->lt($start)) return 0;
        $startMonth = Carbon::create($start->year, $start->month, 1);
        $endMonth   = Carbon::create($end->year, $end->month, 1);
        return $startMonth->diffInMonths($endMonth) + 1;
    }
}
