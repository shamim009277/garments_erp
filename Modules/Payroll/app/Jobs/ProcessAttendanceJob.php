<?php

namespace Modules\Payroll\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\CompanyWiseRamadanShift;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Tools\Calender;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Models\Tools\PunchData;
use Modules\HRIS\Models\JobStatus;
use Modules\HRIS\Models\Setup\Department;

class ProcessAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $month;
    protected $year;
    protected $org_id;
    protected $user_id;
    protected $jobStatusId;

    public $timeout = 7200; // 2 hours

    public function __construct($month, $year, $org_id, $user_id, $jobStatusId)
    {
        $this->month = $month;
        $this->year = $year;
        $this->org_id = $org_id;
        $this->user_id = $user_id;
        $this->jobStatusId = $jobStatusId;
    }

    public function handle()
    {
        try {
            ini_set('memory_limit', '2048M');
            
            $month = $this->month;
            $year = $this->year;
            $today = Carbon::now()->format('Y-m-d');
            $org_id = $this->org_id;
            
            $startdt = Carbon::parse($year . '-' . $month)->startOfMonth()->format('Y-m-d');
            $enddt   = Carbon::parse($startdt)->endOfMonth()->format('Y-m-d');
            
            $startTime = microtime(true);
            $totalEmployees = 0;

            $this->updateStatus('processing', 0, 'Initializing Attendance Process (v1.2)...');
            Log::info("Job ProcessAttendanceJob v1.2 started.");

            $ramadandate = ['rm_seart_date' => '2026-01-01','rm_end_date' => '2026-01-15'];
            $baseshift = Shift::active()->select('shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get();
            $companyshift = CompanyWiseShift::active()->where('org_id', $org_id)->select('org_id', 'shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get();
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                Log::error("ProcessAttendanceJob: No shift found for Org ID {$org_id}");
                $this->updateStatus('failed', 0, "No shift found for Org ID {$org_id}");
                return;
            }

            // Check for Calendar Data
            $calendarCount = Calender::whereMonth('date', $month)->where('is_active', 1)->whereYear('date', $year)->count();
            if ($calendarCount == 0) {
                Log::error("ProcessAttendanceJob: No active calendar data found for Month: {$month}, Year: {$year}");
                $this->updateStatus('failed', 0, "No active calendar data found for Month: {$month}, Year: {$year}. Please generate calendar first.");
                return;
            }

            // Get unique Department IDs that have relevant employees
            $departmentIds = Employee::where('org_id', $org_id)
                ->where(function($query) use($startdt){
                    $query->where('reason', 'N')
                        ->orWhere('leaving_date', '>=', $startdt);
                })
                ->whereNotNull('refrerence_shift')
                ->distinct()
                ->pluck('department_id')
                ->toArray();

            $totalDepartments = count($departmentIds);
            
            if ($totalDepartments === 0) {
                 $this->updateStatus('failed', 0, "No departments with employees to process.");
                 return;
            }

            $processedDepartments = 0;
            $totalInserted = 0;

            Log::info("Processing {$totalDepartments} departments for Attendance.");

            foreach ($departmentIds as $departmentId) {
                $departmentName = Department::where('id', $departmentId)->value('department') ?? "ID: {$departmentId}";
                
                // Fetch employees for this department
                $employees = Employee::where('org_id', $org_id)
                    ->where('department_id', $departmentId)
                    ->where(function($query) use($startdt){
                        $query->where('reason', 'N')
                            ->orWhere('leaving_date', '>=', $startdt);
                    })
                    ->whereNotNull('refrerence_shift')
                    ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift', 'ot_payable', 'mtreturn_date', 'joining_date', 'punch_category')
                    ->orderBy('employee_id')
                    ->get();
                
                $employeeCount = $employees->count();
                $totalEmployees += $employeeCount;
                Log::info("Department {$departmentName} (ID: {$departmentId}): Found {$employeeCount} employees.");

                $progress = round(($processedDepartments / $totalDepartments) * 100);
                $this->updateStatus('processing', $progress, "Processing: {$departmentName} ({$employeeCount} employees)");

                if ($employeeCount == 0) {
                    $processedDepartments++;
                    continue;
                }

                // *** Department-wise Clean Up ***
                // Delete existing records for this department's employees for this month
                ProcessAttendence::where('org_id', $org_id)
                    ->whereIn('employee_id', $employees->pluck('employee_id'))
                    ->whereMonth('work_date', $month)
                    ->whereYear('work_date', $year)
                    ->delete();

                // Chunk employees within the department for memory safety
                $splitemps = $employees->chunk(50);

                foreach ($splitemps as $splitemp) {
                    $allempid = $splitemp->pluck('employee_id')->toArray();
                    $shiftempids = $splitemp->where('shifting_duty', 'Y')->pluck('employee_id')->toArray();

                    $assignshift = ShiftingList::whereIn('employee_id', $allempid)->whereMonth('date', $month)->whereYear('date', $year)->whereBetween('date', [$startdt, $enddt])->get();
                    
                    if ($assignshift->isEmpty()) {
                        Log::warning("No Shifting List found for chunk of " . count($allempid) . " employees. Month: $month, Year: $year");
                    } else {
                        Log::info("Found " . $assignshift->count() . " shifting records for chunk.");
                    }

                    $caldatas = Calender::whereMonth('date', $month)->where('is_active', 1)->whereYear('date', $year)->whereBetween('date', [$startdt, $enddt])->select('date', 'year', 'month', 'holiday', 'public_holiday')->get();
                    $leavedatas = DB::table('hris_database_leave_confirmation')->orderBy('employee_id', 'ASC')->orderBy('start_date', 'ASC')->whereIn('employee_id', $allempid)->where(function($q) use($startdt, $enddt){
                        $q->whereBetween('start_date', [$startdt, $enddt])->orWhereBetween('end_date', [$startdt, $enddt]);
                    })->select('employee_id', 'start_date', 'end_date', 'leave_type_id')->get();
                    
                    $allpunchrecords = PunchData::whereIn('employee_id', $allempid)->whereMonth('work_date', $month)->whereYear('work_date', $year)->whereBetween('work_date', [$startdt, $enddt])->get();

                    $excepholiday = ExceptionalHoliday::whereIn('employee_id', $shiftempids)
                            ->whereMonth('holiday_date', $month)
                            ->where('year', $year)
                            ->whereBetween('holiday_date', [$startdt, $enddt])
                            ->get();

                    // Group data
                    $allPunchGrouped = $allpunchrecords->groupBy('employee_id');
                    $allShiftGrouped = $assignshift->groupBy('employee_id');
                    $allExcepholidayGrouped = $excepholiday->groupBy('employee_id');

                    $results = [];

                    foreach ($splitemp as $employee) {
                        $empid = $employee['employee_id'];
                        $empPunches = $allPunchGrouped->get($empid, collect());
                        $empShifts = $allShiftGrouped->get($empid, collect());
                        $empExcepholiday = $allExcepholidayGrouped->get($empid, collect());
                        
                        // start date
                        if ($employee->joining_date >= $startdt) {
                            $start_date = $employee->joining_date;
                        } else {
                            $mtreturndate = ($employee->mtreturn_date && $employee->mtreturn_date != '0000-00-00')
                                ? Carbon::parse($employee->mtreturn_date)->startOfMonth()->format('Y-m-d')
                                : null;

                            if ($startdt == $mtreturndate) {
                                $start_date = Carbon::parse($mtreturndate)->addDays(1)->format('Y-m-d');
                            } else {
                                $start_date = $startdt;
                            }
                        }

                        // end date
                        if ($employee->leaving_date > $startdt && $employee->leaving_date <= $enddt) {
                            $end_date = Carbon::parse($employee->leaving_date)->subDays(1)->format('Y-m-d');
                        } else {
                            $end_date = $enddt;
                        }

                        // Start date and end date validation
                        if ($start_date > $end_date) {
                            continue;
                        }
                        $end_date = $end_date >= $today ? $today : $end_date;
                        $period = CarbonPeriod::create($start_date, $end_date);
                        
                        foreach ($period as $date) {
                            $comdate = $date->format('Y-m-d');
                            try {
                                $shiftEntry = $empShifts->first(function ($item) use ($comdate) {
                                    return substr($item->date, 0, 10) === $comdate;
                                });
                                $shift = $shiftEntry?->shift ?? $employee->refrerence_shift;
                                
                                $shiftinfo = collect($companyshift)->where('shift', $shift)->first() ?? collect($baseshift)->where('shift', $shift)->first();
                                $calendardata = $caldatas->first(function ($item) use ($comdate) {
                                    return substr($item->date, 0, 10) === $comdate;
                                });
                                $leavedata = $leavedatas->where('employee_id', $empid)->where('start_date', '<=', $comdate)->where('end_date', '>=', $comdate)->first();
                                $punchdata = $empPunches->first(function ($item) use ($comdate) {
                                    return substr($item->work_date, 0, 10) === $comdate;
                                });

                                if ($ramadandate && Carbon::parse($comdate)->between($ramadandate['rm_seart_date'],$ramadandate['rm_end_date'])){
                                    $shiftinfo = $ramadanshift->get($shift)??$shiftinfo;
                                }

                                if (!$shiftinfo) {
                                    Log::warning("No shift info found for employee {$empid} on {$comdate} (Shift: {$shift})");
                                    continue;
                                }
                                if (!$calendardata) {
                                    Log::warning("No calendar data found for {$comdate}");
                                    continue; 
                                };

                                $startDtObj = $date->copy()->setTimeFromTimeString($shiftinfo->shift_start);
                                $endDtObj = $date->copy()->setTimeFromTimeString($shiftinfo->shift_end);

                                if ($endDtObj->lt($startDtObj)) {
                                    $endDtObj->addDay();
                                }

                                $starthr = $startDtObj->format('Y-m-d H:i:s');
                                $endhr = $endDtObj->format('Y-m-d H:i:s');
                                $formattedDate = $date->format('Y-m-d');

                                $breakStartObj = $date->copy()->setTimeFromTimeString($shiftinfo->break_start);
                                $breakEndObj = $date->copy()->setTimeFromTimeString($shiftinfo->break_end);

                                if ($breakStartObj->lt($startDtObj)) {
                                    $breakStartObj->addDay();
                                }
                                if ($breakEndObj->lt($startDtObj)) {
                                    $breakEndObj->addDay();
                                }
                                if ($breakEndObj->lt($breakStartObj)) {
                                    $breakEndObj->addDay();
                                }

                                $break_start = $breakStartObj->format('Y-m-d H:i:s');
                                $break_end = $breakEndObj->format('Y-m-d H:i:s');
                                $date = $formattedDate;

                                $wwhvalue = in_array($employee->shift, ['M', 'N']) ? 11 : 8;

                                if ($leavedata) {
                                    $wwh = $leavedata->leave_type_id == "ML" || $leavedata->leave_type_id == "LWOP" ? 0 : $wwhvalue;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => $leavedata->leave_type_id, 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                    continue;
                                }else if($employee->punch_category == 1 && ($punchdata?->start_punch != null || $punchdata?->end_punch != null)){
                                    $wwh = $wwhvalue;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => $punchdata->start_punch, 'end_punch' => $punchdata->end_punch, 'wwh' => $wwh, 'rwh' => $wwhvalue, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => $wwhvalue, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                }
                                else if ($employee->punch_category == 3) {
                                    $wwh = $wwhvalue;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => $wwhvalue, 'wwh' => 8, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => $wwhvalue, 'attn_type' => 'PR', 'is_late' => 'N', 'is_early_leave' => 'N', 'late_minutes' => 0, 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                }
                                else if ($calendardata && $calendardata->public_holiday == 'Y') {
                                    $wwh = $wwhvalue;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                    continue;
                                } else if ($calendardata && $calendardata->holiday == 'Y') {
                                    if($employee && $employee->shifting_duty == 'Y'){
                                        $excepholiday = $empExcepholiday->where('holiday_date',$date)->first();
                                        if($excepholiday && Carbon::parse($excepholiday->holiday_date)->format('Y-m-d') == $date){
                                            if ($employee && $employee->ot_payable == 'N') {
                                                $wwh = 11;
                                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                            } else if ($employee && $employee->ot_payable == 'Y') {
                                                $wwh = 11;
                                                $start_punch = $punchdata?->start_punch;
                                                $end_punch   = $punchdata?->end_punch;
                                                $totalhour = calculateTotalHours($start_punch, $end_punch);

                                                if ($totalhour > 0) {
                                                    $othour = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => $totalhour, 'ot_hours' => $othour['hours'] ?? 0, 'ot_minutes' => $othour['minutes'] ?? 0, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                                } else {
                                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => 0, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                                }
                                            }
                                        }
                                    }else{
                                        if ($employee && $employee->ot_payable == 'N') {
                                            $wwh = 8;
                                            $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                        } else if ($employee && $employee->ot_payable == 'Y') {
                                            $wwh = 8;
                                            $start_punch = $punchdata?->start_punch;
                                            $end_punch   = $punchdata?->end_punch;
                                            $totalhour = calculateTotalHours($start_punch, $end_punch);

                                            if ($totalhour > 0) {
                                                $othour = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => $totalhour, 'ot_hours' => $othour['hours'] ?? 0, 'ot_minutes' => $othour['minutes'] ?? 0, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                            } else {
                                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => 0, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                            }
                                        }
                                    }
                                } else if ($employee->punch_category == 2 && ($punchdata?->start_punch != null || $punchdata?->end_punch != null)) {
                                    // check shifting duty 
                                    $excepholiday = $empExcepholiday->where('holiday_date',$date)->first();
                                    if ($employee && $employee->shifting_duty == 'Y' && ($excepholiday && Carbon::parse($excepholiday->holiday_date)->format('Y-m-d') == $date)) {
                                        $wwh = $wwhvalue;
                                        $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                    }else {
                                        $start_punch = $punchdata?->start_punch;
                                        $end_punch   = $punchdata?->end_punch;

                                        if ($start_punch <= $starthr && $endhr <= $end_punch) {
                                            $actualHours = calculateActualHours($starthr, $endhr, $break_start, $break_end);
                                        } elseif ($start_punch > $starthr && $endhr <= $end_punch) {
                                            $actualHours = calculateActualHours($start_punch, $endhr, $break_start, $break_end);
                                        } elseif ($start_punch <= $starthr && $endhr > $end_punch) {
                                            $actualHours = calculateActualHours($starthr, $end_punch, $break_start, $break_end);
                                        } elseif ($start_punch > $starthr && $endhr > $end_punch) {
                                            $actualHours = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                                        } else {
                                            $actualHours = ['hours' => 0, 'minutes' => 0, 'totalHours' => 0];
                                        }

                                        if (!is_array($actualHours)) {
                                            $actualHours = ['hours' => 0, 'minutes' => 0, 'totalHours' => 0];
                                        }

                                        $latelimit = Carbon::parse($starthr)->addMinutes($shiftinfo->late_after_minutes)->format('Y-m-d H:i:s');
                                        $earlylimit = Carbon::parse($endhr)->format('Y-m-d H:i:s');

                                        if ($start_punch > $latelimit) {
                                            $islate = 'Y';
                                            $lateMinutes = round(calculateLate($start_punch, $starthr));
                                        } else {
                                            $islate = 'N';
                                            $lateMinutes = 0;
                                        }

                                        if ($end_punch < $earlylimit) {
                                            $isEarlyLeave = 'Y';
                                            $earlyMinutes = round(calculateLate($endhr, $end_punch));
                                        } else {
                                            $isEarlyLeave = 'N';
                                            $earlyMinutes = 0;
                                        }

                                        $actualOT = $endhr < $end_punch ? ($endhr > $start_punch ? calculateOtHours($endhr, $end_punch) : calculateOtHours($start_punch, $end_punch)) : ['hours' => 0, 'minutes' => 0];
                                        $rwh = $actualHours['hours'] > $wwhvalue ? $wwhvalue : $actualHours['hours'];
                                        $othour = $actualOT['hours'];
                                        $otminutes = round($actualOT['minutes']);
                                        $wwh = $wwhvalue;
                                        $totalhour = $actualHours['totalHours'];
                                        $shortMinutes = round($lateMinutes + $earlyMinutes);

                                        if ($employee->ot_payable == 'N') {
                                            $othour = 0;
                                            $otminutes = 0;
                                        }
                                        
                                        $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'rwh' => $rwh, 'wwh' => $wwh, 'ot_hours' => $othour, 'ot_minutes' => $otminutes, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => $islate, 'is_early_leave' => $isEarlyLeave, 'late_minutes' => $lateMinutes, 'early_minutes' => $earlyMinutes, 'short_minutes' => $shortMinutes, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                    }
                                }  else {
                                    $wwh = 0;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'AB', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => $this->user_id, 'updated_by' => $this->user_id];
                                }
                            } catch (\Throwable $th) {
                                Log::error('Process Attendence failed', [
                                    'employee' => $employee->employee_id,
                                    'date' => $date,
                                    'error' => $th->getMessage(),
                                ]);
                                continue;
                            }
                        }
                    }

                    // insert data
                    if (!empty($results)) {
                        ProcessAttendence::insert($results);
                        $totalInserted += count($results);
                    }
                }

                $processedDepartments++;
            }

            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            $completionMsg = "Process Complete. Employees: {$totalEmployees}, Inserted: {$totalInserted}, Time: {$duration}s";

            $this->updateStatus('completed', 100, $completionMsg);
            Log::info("Attendance Processed successfully. $completionMsg");

        } catch (\Exception $e) {
            Log::error("ProcessAttendanceJob Global Fail: " . $e->getMessage());
            $this->updateStatus('failed', 0, "Failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function updateStatus($status, $progress, $message)
    {
        DB::table('job_statuses')->where('id', $this->jobStatusId)->update([
            'status' => $status,
            'progress' => $progress,
            'message' => $message,
            'updated_at' => now()
        ]);
    }
}
