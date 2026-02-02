<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\Database\EmpGatePass;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\RamadanSchedule;
use Modules\HRIS\Models\Setup\CompanyWiseRamadanShift;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Tools\Calender;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Models\Tools\PunchData;
use Modules\Payroll\Models\Tools\ReadMachineData;
use Modules\Payroll\Jobs\ProcessAttendanceJob;
use Modules\Payroll\Jobs\PreProcessAttendanceJob;
use Modules\HRIS\Models\JobStatus;
use Illuminate\Support\Str;

class ProcessAttendenceController extends Controller
{
    public function index()
    {
        $month = (int)Carbon::now()->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        $date = Carbon::now()->format('d-m-Y');
        return view('payroll::tools.processattendence.index', compact('organizations', 'month', 'yearlist', 'date'));
    }

    public function create()
    {
        return view('payroll::create');
    }

    public function store(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        switch ($request->title) {
            case 1:
                return $this->handlePreProcess($request);
            case 2:
                return $this->handleDeletePreProcess($request);
            case 3:
                return $this->handleProcessAttendance($request);
            case 4:
                return $this->handleDeleteProcess($request);
            default:
                return back()->with('error', 'Invalid request type.');
        }
    }

    private function handlePreProcess(Request $request)
    {
        $preDate = Carbon::parse($request->date);
        
        $start_date = $preDate->copy()->startOfMonth();
        $end_date   = $preDate->copy()->endOfMonth();
        
        // Check if already exists
        if (PunchData::where('org_id', $request->org_id)->whereBetween('work_date', [$start_date, $end_date])->exists()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Pre process attendance already exists for this month.'], 400);
            }
            return back()->with('error', 'Pre process attendance already exists for this month.');
        }

        $startdt = $start_date->format('Y-m-d');

        // Fetch all active departments that have employees to process
        $departmentIds = Employee::where('org_id', $request->org_id)
            ->whereNotNull('refrerence_shift')
            ->where(function ($q) use ($startdt) {
                $q->where('reason', 'N')
                  ->orWhere('leaving_date', '>=', $startdt);
            })
            ->select('department_id')
            ->distinct()
            ->pluck('department_id')
            ->toArray();

        if (empty($departmentIds)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'No employees found to process for this month.'], 400);
            }
            return back()->with('error', 'No employees found to process for this month.');
        }

        try {
            // Create Job Status Record
            $jobStatus = JobStatus::create([
                'job_id' => (string) Str::uuid(),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'progress' => 0,
                'message' => 'Pre-process attendance queued...'
            ]);

            // Dispatch Job
            PreProcessAttendanceJob::dispatch($request->date, $request->org_id, $departmentIds, Auth::id(), $jobStatus->id);

            // If the request expects JSON (AJAX), return JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pre-process started in background. Please wait for completion.',
                    'job_status_id' => $jobStatus->id
                ]);
            }

            return back()->with('success', "Pre-process started. Please wait for completion. (Job ID: {$jobStatus->id})");

        } catch (\Throwable $th) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to start process: ' . $th->getMessage()], 500);
            }
            return back()->with('error', 'Failed to start process: ' . $th->getMessage());
        }
    }

    private function handleDeletePreProcess(Request $request)
    {
        $startTime = microtime(true);
        $month = $request->month;
        $year  = $request->year;

        $count = PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $request->org_id)->count();
        
        if ($count > 0) {
            PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $request->org_id)->delete();
            
            $lastId = DB::table('payroll_tools_punch_data')->max('id') ?? 0;
            DB::statement("ALTER TABLE payroll_tools_punch_data AUTO_INCREMENT = " . ($lastId + 1));
            
            $executionTime = round(microtime(true) - $startTime, 3);
            return back()->with('success', "Attendance Pre Process deleted successfully. Time taken: {$executionTime}s. Total deleted: {$count}");
        }

        return back()->with('error', 'No punch data found for this month/year.');
    }

    private function handleProcessAttendance(Request $request)
    {
        $month = $request->month;
        $year  = $request->year;
        $org_id = $request->org_id;

        if (ProcessAttendence::where('org_id', $org_id)->whereMonth('work_date', $month)->whereYear('work_date', $year)->exists()) {
            return back()->with('error', 'Attendance Process data already exists for this month/year.');
        }

        $startdt = Carbon::parse("$year-$month")->startOfMonth()->format('Y-m-d');
        
        // Fetch all active departments that have employees to process
        // We filter departments that have at least one active employee or employee leaving after start date
        $departmentIds = Employee::where('org_id', $org_id)
            ->whereNotNull('refrerence_shift')
            ->where(function ($q) use ($startdt) {
                $q->where('reason', 'N')
                  ->orWhere('leaving_date', '>=', $startdt);
            })
            ->select('department_id')
            ->distinct()
            ->pluck('department_id')
            ->toArray();

        if (empty($departmentIds)) {
            return back()->with('error', 'No employees found to process for this month.');
        }

        try {
            // Create Job Status Record
            $jobStatus = JobStatus::create([
                'job_id' => (string) Str::uuid(),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'progress' => 0,
                'message' => 'Attendance process queued...'
            ]);

            // Dispatch Job
            ProcessAttendanceJob::dispatch($month, $year, $org_id, $departmentIds, Auth::id(), $jobStatus->id);

            // If the request expects JSON (AJAX), return JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Attendance processing started in background. Please wait for completion.',
                    'job_status_id' => $jobStatus->id
                ]);
            }

            return back()->with('success', "Attendance processing started. Please wait for completion. (Job ID: {$jobStatus->id})");
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to start process: ' . $th->getMessage());
        }
    }

    public function checkStatus($id)
    {
        $jobStatus = JobStatus::find($id);

        if (!$jobStatus) {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $jobStatus->status,
            'progress' => $jobStatus->progress,
            'message' => $jobStatus->message
        ]);
    }

    private function processAttendanceBatch($employees, $startdt, $enddt, $month, $year, $baseshift, $companyshift, $ramadanshift, $ramadandate, $exceptionalHolidays)
    {
        $empIds = $employees->pluck('employee_id')->toArray();
        
        $shifts = ShiftingList::whereIn('employee_id', $empIds)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereBetween('date', [$startdt, $enddt])
            ->get()
            ->groupBy('employee_id');

        $caldatas = Calender::whereMonth('date', $month)
            ->where('is_active', 1)
            ->whereYear('date', $year)
            ->whereBetween('date', [$startdt, $enddt])
            ->select('date', 'year', 'month', 'holiday', 'public_holiday')
            ->get()
            ->keyBy(function($item) {
                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            }); // Optimize lookup

        $leavedatas = DB::table('hris_database_leave_confirmation')
            ->whereBetween('start_date', [$startdt, $enddt])
            ->orWhereBetween('end_date', [$startdt, $enddt])
            ->select('employee_id', 'start_date', 'end_date', 'leave_type_id')
            ->get();

        $punches = PunchData::whereIn('employee_id', $empIds)
            ->whereMonth('work_date', $month)
            ->whereYear('work_date', $year)
            ->whereBetween('work_date', [$startdt, $enddt])
            ->get()
            ->groupBy('employee_id');
        
        $batchExceptionalHolidays = ExceptionalHoliday::whereIn('holiday_date', $exceptionalHolidays)
             ->whereIn('employee_id', $empIds) // Optimization
             ->get()
             ->groupBy('employee_id');

        Log::info("Processing Batch", [
            'employee_count' => count($employees),
            'calendar_days_found' => $caldatas->count(),
            'shifts_found' => $shifts->flatten()->count(),
            'punches_found' => $punches->flatten()->count()
        ]);

        $insertData = [];
        foreach ($employees as $employee) {
            $empid = $employee->employee_id;
            $empPunches = $punches->get($empid, collect());
            $empShifts = $shifts->get($empid, collect());
            $empExceptionalHoliday = $batchExceptionalHolidays->get($empid, collect());
            $empLeaves = $leavedatas->where('employee_id', $empid);

            list($start_date, $end_date) = $this->getEmployeeDateRange($employee, $startdt, $enddt);

            $period = CarbonPeriod::create($start_date, $end_date);

            foreach ($period as $dt) {
                $date = $dt->format('Y-m-d');
                $result = $this->calculateDailyAttendance(
                    $employee, 
                    $date, 
                    $empShifts, 
                    $baseshift, 
                    $companyshift, 
                    $caldatas, 
                    $empLeaves, 
                    $empPunches, 
                    $empExceptionalHoliday,
                    $ramadandate,
                    $ramadanshift
                );

                if ($result) {
                    $insertData[] = $result;
                }
            }
        }

        if (!empty($insertData)) {
            try {
                ProcessAttendence::insert($insertData);
            } catch (\Exception $e) {
                Log::error("Attendance Insert Failed", ['error' => $e->getMessage()]);
            }
        }
        
        return count($insertData);
    }

    private function calculateDailyAttendance($employee, $date, $empShifts, $baseshift, $companyshift, $caldatas, $empLeaves, $empPunches, $empExceptionalHoliday, $ramadandate, $ramadanshift)
    {
        try {
            $shift = $empShifts->firstWhere('date', $date)?->shift ?? $employee->refrerence_shift;
            $shiftinfo = $this->getShiftInfo($shift, $date, $baseshift, $companyshift, $ramadandate, $ramadanshift);
            
            if (!$shiftinfo) {
                Log::warning("Shift Info Missing", ['employee' => $employee->employee_id, 'date' => $date, 'shift' => $shift]);
                return null;
            }

            $calendardata = $caldatas[$date] ?? null;
            if (!$calendardata) {
                Log::warning("Calendar Data Missing", ['employee' => $employee->employee_id, 'date' => $date, 'available_keys_sample' => array_keys($caldatas->take(5)->toArray())]);
                return null;
            }

            $leavedata = $empLeaves->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();
            $punchdata = $empPunches->firstWhere('work_date', $date);
            
            $starthr = Carbon::parse("$date $shiftinfo->shift_start")->format('Y-m-d H:i:s');
            $endhr = Carbon::parse("$date $shiftinfo->shift_end")->format('Y-m-d H:i:s');
            $break_start = Carbon::parse("$date $shiftinfo->break_start")->format('Y-m-d H:i:s');
            $break_end = Carbon::parse("$date $shiftinfo->break_end")->format('Y-m-d H:i:s');

            $isShifting = $employee->shifting_duty == 'Y';
            $isNMShift = in_array($shift, ['N', 'M']);
            
            // Determine WWH (Work Week Hours)
            $baseWWH = $isShifting ? 11 : 8;
            $observeHolidays = !$isShifting || ($isShifting && $isNMShift);

            // 1. Check Leave
            if ($leavedata && $observeHolidays) {
                $wwh = ($leavedata->leave_type_id == "ML" || $leavedata->leave_type_id == "LWOP") ? 0 : $baseWWH;
                return $this->formatResult($employee, $shift, $date, null, null, 0, $wwh, 0, 0, 0, $leavedata->leave_type_id);
            }

            // 2. Check Public Holiday
            if ($calendardata->public_holiday == 'Y' && $observeHolidays) {
                return $this->formatResult($employee, $shift, $date, null, null, 0, $baseWWH, 0, 0, 0, 'HD');
            }

            // 3. Check Weekly Holiday / Exceptional Holiday
            $isHoliday = false;
            if ($isShifting) {
                $holiday = $empExceptionalHoliday->firstWhere('holiday_date', $date);
                if ($holiday && $holiday->holiday_date == $date && $isNMShift) {
                    $isHoliday = true;
                }
            } else {
                if ($calendardata->holiday == 'Y') {
                    $isHoliday = true;
                }
            }

            if ($isHoliday) {
                if ($employee->ot_payable == 'N') {
                    return $this->formatResult($employee, $shift, $date, null, null, 0, $baseWWH, 0, 0, 0, 'HD');
                } else {
                    $start_punch = $punchdata?->start_punch;
                    $end_punch   = $punchdata?->end_punch;
                    $totalhour = calculateTotalHours($start_punch, $end_punch);

                    if ($totalhour > 0) {
                        $othour = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                        return $this->formatResult($employee, $shift, $date, $start_punch, $end_punch, $totalhour, $baseWWH, $othour['hours'] ?? 0, $othour['minutes'] ?? 0, $totalhour, 'PR');
                    } else {
                        return $this->formatResult($employee, $shift, $date, $start_punch, $end_punch, 0, $baseWWH, 0, 0, 0, 'HD');
                    }
                }
            }

            // 4. Check Punch Category
            $start_punch = $punchdata?->start_punch;
            $end_punch   = $punchdata?->end_punch;
            $hasPunch = ($start_punch != null || $end_punch != null);

            if ($employee->punch_category == 1 && $hasPunch) {
                // Category 1: Present if punch exists, fixed 8 hours
                return $this->formatResult($employee, $shift, $date, $start_punch, $end_punch, 8, $baseWWH, 0, 0, 8, 'PR');
            } 
            elseif ($employee->punch_category == 2 && $hasPunch) {
                // Category 2: Calculated hours
                $actualHours = $this->calculateWorkingHours($start_punch, $end_punch, $starthr, $endhr, $break_start, $break_end);
                
                $latelimit = Carbon::parse($starthr)->addMinutes($shiftinfo->late_after_minutes)->format('Y-m-d H:i:s');
                $earlylimit = Carbon::parse($endhr)->format('Y-m-d H:i:s');

                $islate = ($start_punch > $latelimit) ? 'Y' : 'N';
                $lateMinutes = ($islate == 'Y') ? calculateLate($start_punch, $starthr) : 0;

                $isEarlyLeave = ($end_punch < $earlylimit) ? 'Y' : 'N';
                $earlyMinutes = ($isEarlyLeave == 'Y') ? calculateLate($endhr, $end_punch) : 0;

                $actualOT = ($endhr < $end_punch) 
                    ? (($endhr > $start_punch) ? calculateOtHours($endhr, $end_punch) : calculateOtHours($start_punch, $end_punch)) 
                    : ['hours' => 0, 'minutes' => 0];

                $rwh = ($actualHours['hours'] > $baseWWH) ? $baseWWH : $actualHours['hours'];
                $othour = ($employee->ot_payable == 'N') ? 0 : $actualOT['hours'];
                $otminutes = ($employee->ot_payable == 'N') ? 0 : $actualOT['minutes'];
                $totalhour = $actualHours['totalHours'];
                $shortMinutes = round($lateMinutes + $earlyMinutes);

                if ($totalhour > 0) {
                    return $this->formatResult($employee, $shift, $date, $start_punch, $end_punch, $rwh, $baseWWH, $othour, $otminutes, $totalhour, 'PR', $islate, $lateMinutes, $isEarlyLeave, $earlyMinutes, $shortMinutes);
                } else {
                    return $this->formatResult($employee, $shift, $date, $start_punch, $end_punch, 0, 0, 0, 0, 0, 'AB');
                }
            } 
            elseif ($employee->punch_category == 3) {
                // Category 3: Auto Present
                return $this->formatResult($employee, $shift, $date, null, null, 8, $baseWWH, 0, 0, 8, 'PR');
            } 
            else {
                // Default: Absent
                return $this->formatResult($employee, $shift, $date, null, null, 0, 0, 0, 0, 0, 'AB');
            }

        } catch (\Throwable $th) {
            Log::error('Process Attendance failed', [
                'employee' => $employee->employee_id,
                'date' => $date,
                'error' => $th->getMessage()
            ]);
            return null;
        }
    }

    private function getShiftInfo($shift, $date, $baseshift, $companyshift, $ramadandate, $ramadanshift)
    {
        $shiftinfo = $companyshift[$shift] ?? $baseshift[$shift] ?? null;

        if ($ramadandate && $ramadanshift && $date >= $ramadandate->start_date && $date <= $ramadandate->end_date) {
            $shiftinfo = $ramadanshift[$shift] ?? $shiftinfo;
        }

        return $shiftinfo;
    }

    private function getEmployeeDateRange($employee, $startdt, $enddt)
    {
        if ($employee->joining_date >= $startdt) {
            $start_date = $employee->joining_date;
        } else {
            $mtreturndate = ($employee->mtreturn_date && $employee->mtreturn_date != '0000-00-00')
                ? Carbon::parse($employee->mtreturn_date)->startOfMonth()->format('Y-m-d')
                : null;
            $start_date = ($startdt == $mtreturndate) ? Carbon::parse($mtreturndate)->addDays(1)->format('Y-m-d') : $startdt;
        }

        $end_date = ($employee->leaving_date > $startdt && $employee->leaving_date <= $enddt)
            ? Carbon::parse($employee->leaving_date)->subDays(1)->format('Y-m-d')
            : $enddt;

        return [$start_date, $end_date];
    }

    private function calculateWorkingHours($start_punch, $end_punch, $starthr, $endhr, $break_start, $break_end)
    {
        if ($start_punch <= $starthr && $endhr <= $end_punch) {
            return calculateActualHours($starthr, $endhr, $break_start, $break_end);
        } elseif ($start_punch > $starthr && $endhr <= $end_punch) {
            return calculateActualHours($start_punch, $endhr, $break_start, $break_end);
        } elseif ($start_punch <= $starthr && $endhr > $end_punch) {
            return calculateActualHours($starthr, $end_punch, $break_start, $break_end);
        } elseif ($start_punch > $starthr && $endhr > $end_punch) {
            return calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
        }
        return ['hours' => 0, 'totalHours' => 0]; // Fallback
    }

    private function formatResult($employee, $shift, $date, $start, $end, $rwh, $wwh, $oth, $otm, $total, $type, $isLate='N', $lateMin=0, $isEarly='N', $earlyMin=0, $shortMin=0)
    {
        return [
            'org_id' => $employee->org_id,
            'employee_id' => $employee->employee_id,
            'shift' => $shift,
            'work_date' => $date,
            'start_punch' => $start,
            'end_punch' => $end,
            'rwh' => $rwh,
            'wwh' => $wwh,
            'ot_hours' => $oth,
            'ot_minutes' => $otm,
            'total_hours' => $total,
            'attn_type' => $type,
            'is_late' => $isLate,
            'late_minutes' => $lateMin,
            'is_early_leave' => $isEarly,
            'early_minutes' => $earlyMin,
            'short_minutes' => $shortMin,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ];
    }

    private function handleDeleteProcess(Request $request)
    {
        $startTime = microtime(true);
        $month = $request->month;
        $year  = $request->year;

        $count = ProcessAttendence::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $request->org_id)->count();

        if ($count > 0) {
            ProcessAttendence::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $request->org_id)->delete();
            
            $lastId = DB::table('payroll_tools_process_attendence')->max('id') ?? 0;
            DB::statement("ALTER TABLE payroll_tools_process_attendence AUTO_INCREMENT = " . ($lastId + 1));

            $executionTime = round(microtime(true) - $startTime, 3);
            return back()->with('success', "✅ Attendance Process deleted successfully. Total deleted rows: {$count}. Time taken: {$executionTime}s");
        }

        return back()->with('error', 'No attendance data found for this month/year.');
    }

    public function show($id)
    {
        return view('payroll::show');
    }

    public function edit($id)
    {
        return view('payroll::edit');
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
