<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\LeaveApplication;
use Modules\HRIS\Models\Database\LeaveConfirmation;
use Modules\HRIS\Models\Setup\LeaveClassification;

trait LeaveBalance
{
    public function calculateAccrualUpToToday(int $employeeId): array
    {
        $today = now();
        $yearStart = $today->copy()->startOfYear();

        $employee = Employee::where('employee_id', $employeeId)->select('id','joining_date')->first();
        $joining  = Carbon::parse($employee->joining_date);

        // leave classification data
        $leaveclassdata = LeaveClassification::query()->active()->get();

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

        // CL Calculation
        $cldata = $leaveclassdata->firstWhere('code', 'CL');

        $CL_DAYS_PER_CREDIT = $cldata ? (int)$cldata->pay_ratio : 36;
        $CL_CAP_PER_YEAR    = $cldata ? (int)$cldata->yearly_limit : 10;

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
        //$SL_ANNUAL_QUOTA = 10;

        $slData = $leaveclassdata->firstWhere('code', 'SL');

        $SL_DAYS_PER_CREDIT = $slData ? (int)$slData->pay_ratio : 26;
        $SL_ANNUAL_QUOTA    = $slData ? (int)$slData->yearly_limit : 14;

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

        // ===== EL Calculation =====
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

        // EL Calculation
        $elData = $leaveclassdata->firstWhere('code', 'EL');

        $EL_DAYS_PER_CREDIT = $elData ? (int)$elData->pay_ratio : 18;
        $EL_CAP_PER_YEAR    = $elData ? (int)$elData->yearly_limit : 18;

        $elEarned = intdiv($effectiveAttendance, $EL_DAYS_PER_CREDIT);
        //$elEarned = min($elEarned, $EL_CAP_PER_YEAR);

        $elUsed = LeaveApplication::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'EL'))
            ->sum('days');

        $elActualUsed = LeaveConfirmation::where('employee_id', $employeeId)
            ->whereBetween('start_date', [$windowStart, $windowEnd])
            ->whereHas('leaveType', fn($q) => $q->where('code', 'EL'))
            ->sum('days');

        $elRemaining = max(0, $elEarned - $elUsed);
        $elActualRemaining = max(0, $elEarned - $elActualUsed);

        return [
            'window' => [
                'start' => $windowStart->toDateString(),
                'end'   => $windowEnd->toDateString(),
            ],
            'CL' => [
                'earned' => $clEarned,
                'earned_yearly' => $CL_CAP_PER_YEAR,
                'used' => (int) $clUsed,
                'actual_used' => (int) $clActualUsed,
                'remaining' => $clRemaining,
                'actual_remaining' => $clActualRemaining,
            ],
            'SL' => [
                'earned' => $slEarned,
                'earned_yearly' => $SL_ANNUAL_QUOTA,
                'used' => (int) $slUsed,
                'actual_used' => (int) $slActualUsed,
                'remaining' => $slRemaining,
                'actual_remaining' => $slActualRemaining,
            ],
            'EL' => [
                'earned' => $elEarned,
                'earned_yearly' => $EL_CAP_PER_YEAR,
                'used' => (int) $elUsed,
                'actual_used' => (int) $elActualUsed,
                'remaining' => $elRemaining,
                'actual_remaining' => $elActualRemaining,
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
