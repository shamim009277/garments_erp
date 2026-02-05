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
use Modules\HRIS\Models\JobStatus;
use Illuminate\Support\Str;

class ProcessAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ini_set('memory_limit', '2048M');
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        $date = Carbon::now()->format('d-m-Y');

        //$start_date = '2026-01-01'; 
        //$end_date = '2026-01-31';
        // $datas = ProcessAttendence::where('org_id', 1)->whereBetween('work_date', [$start_date, $end_date])->get();
        // $allempids = $datas->pluck('employee_id')->unique()->toArray();

        // $employeeWiseCount = ProcessAttendence::where('org_id', 1)
        //     ->whereBetween('work_date', [$start_date, $end_date])
        //     ->groupBy('employee_id')
        //     ->selectRaw('employee_id, COUNT(*) as total')
        //     ->pluck('total', 'employee_id')
        //     ->toArray();

        //dd($employeeWiseCount);

        // $datas2 = PunchData::where('org_id', 1)->whereBetween('work_date', [$start_date, $end_date])->get();
        // $allpunchempids = $datas2->pluck('employee_id')->unique()->toArray();

        // $diff = array_diff($allpunchempids, $allempids);

        // dd($allempids,$allpunchempids,$diff);

        return view('payroll::tools.processattendence.index', compact('organizations', 'month', 'yearlist', 'date'));
    }

    /**
     * Check Job Status
     */
    public function checkStatus($id)
    {
        $jobStatus = JobStatus::find($id);

        if (!$jobStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $jobStatus->status,
            'progress' => $jobStatus->progress,
            'message' => $jobStatus->message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payroll::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');

        if ($request->title == 1) {
            $startTime = microtime(true);

            $pre_date = Carbon::parse($request->date)->format('Y-m-d');
            $month = Carbon::parse($pre_date)->format('m');
            $year  = Carbon::parse($pre_date)->format('Y');
            $start_date = Carbon::parse($pre_date)->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::parse($pre_date)->endOfMonth()->format('Y-m-d');

            // ✅ Check if punch data already exists for this month
            $exists = PunchData::where('org_id', $request->org_id)->whereBetween('work_date', [$start_date, $end_date])->exists();
            if ($exists) {
                return redirect()->back()->with('error', 'Pre process attendance already exists for this month.');
            }

            $start = $start_date;
            $end = $start <= $pre_date && $pre_date <= $end_date ? $pre_date : $end_date;

            $ramadandate = ['rm_seart_date' => '2026-01-01','rm_end_date' => '2026-01-15'];
            $baseshift = Shift::active()
                ->select('shift', 'shift_start', 'shift_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get();
            $companyshift = CompanyWiseShift::active()
                ->where('org_id', $request->org_id)
                ->select('org_id', 'shift', 'shift_start', 'shift_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get();
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $request->org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                return redirect()->back()->with('error', 'Please add shift. Common shift or company wise shift.');
            }

            $employees = Employee::where('org_id', $request->org_id)
                ->where(function($query) use($start){
                    $query->where('reason', 'N')
                        ->orWhere('leaving_date', '>=', $start);
                })
                //->where('employee_id', 564)
                ->whereNotNull('refrerence_shift')
                ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift','leaving_date','reason')
                ->orderBy('department_id')
                ->orderBy('employee_id')
                ->get();

            //dd($employees);

            $punchstart = Carbon::parse($start)->startOfDay()->format('Y-m-d H:i:s');
            $punchend = Carbon::parse($end)->addDay(1)->endOfDay()->format('Y-m-d H:i:s');

            $splitemps = $employees->chunk(300);
            $totalInserted = 0;

            foreach ($splitemps as $splitemp) {
                $allempid = $splitemp->pluck('employee_id')->toArray();
                $shiftempids = $splitemp->where('shifting_duty', 'Y')->pluck('employee_id')->toArray();

                $gatepassdata = EmpGatePass::whereIn('employee_id', $allempid)
                    ->where('type_id', 2)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->whereBetween('date', [$start, $end])
                    ->get();

                $assignshift = ShiftingList::whereIn('employee_id', $allempid)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->whereBetween('date', [$start, $end])
                    ->get();

                $excepholiday = ExceptionalHoliday::whereIn('employee_id', $shiftempids)
                    ->whereMonth('holiday_date', $month)
                    ->where('year', $year)
                    ->whereBetween('holiday_date', [$start, $end])
                    ->get();

                $allpunchdata = ReadMachineData::whereIn('employee_id', $allempid)
                    ->whereBetween('attendance_date', [$punchstart, $punchend])
                    ->select('employee_id', 'attendance_date')
                    ->get();

                // ✅ Group punch, shift, gatepass by employee
                $allPunchGrouped = $allpunchdata->groupBy('employee_id');
                $allShiftGrouped = $assignshift->groupBy('employee_id');
                $allGatePassGrouped = $gatepassdata->groupBy('employee_id');
                $allExcepholidayGrouped = $excepholiday->groupBy('employee_id');
                $results = [];

                foreach ($splitemp as $employee) {
                    $empid = $employee['employee_id'];
                    $empPunches = $allPunchGrouped->get($empid, collect());
                    $empShifts = $allShiftGrouped->get($empid, collect());
                    $empGatePasses = $allGatePassGrouped->get($empid, collect());

                    if ($employee->leaving_date > $start_date && $employee->leaving_date <= $end_date) {
                        $end_date = Carbon::parse($employee->leaving_date)->subDays(1)->format('Y-m-d');
                    } else {
                        $end_date = $end_date;
                    }

                    //dd($start_date, $end_date);
                    $period = CarbonPeriod::create($start_date, $end_date);
                    
                    //dd($period);

                    foreach ($period as $date) {
                        $comdate = Carbon::parse($date)->format('Y-m-d');
                        $startpunch = null;
                        $endpunch = null;

                        $shift = $empShifts->firstWhere('date', $date->format('Y-m-d'))?->shift
                            ?? $employee['refrerence_shift'];

                        $gatepass = $empGatePasses->firstWhere('date', $date->format('Y-m-d'));

                        $shiftTime = collect($companyshift)->where('shift', $shift)->first()
                            ?? collect($baseshift)->where('shift', $shift)->first();

                        if ($ramadandate && 
                            Carbon::parse($comdate)->between(
                                $ramadandate['rm_seart_date'],
                                $ramadandate['rm_end_date']
                            )
                        ) {
                            $shiftTime = $ramadanshift->get($shift)??$shiftTime;
                        }

                        if (!$shiftTime) continue;

                        $starthr = $date->copy()->setTimeFromTimeString($shiftTime->shift_start);
                        $endhr = $date->copy()->setTimeFromTimeString($shiftTime->shift_end);

                        $startlimit = $starthr->copy()->subHour(2);
                        $endlimit = $endhr->copy()->addHour(
                            $employee->shifting_duty == 'Y' && in_array($shift, ['M','N']) ? 10 : 12
                        );

                        $punchesBeforeStart = $empPunches->filter(
                            fn($p) =>
                            $p->attendance_date > $startlimit && $p->attendance_date <= $starthr
                        );
                        $punchesBetweenShift = $empPunches->filter(
                            fn($p) =>
                            $p->attendance_date > $starthr && $p->attendance_date < $endhr
                        );
                        $punchesAfterEnd = $empPunches->filter(
                            fn($p) =>
                            $p->attendance_date >= $endhr && $p->attendance_date <= $endlimit
                        );

                        // ✅ Determine startpunch
                        if ($punchesBeforeStart->isNotEmpty()) {
                            $startpunch = Carbon::parse($punchesBeforeStart->max('attendance_date'))->format('Y-m-d H:i:s');
                        } elseif ($punchesBetweenShift->isNotEmpty()) {
                            $startpunch = Carbon::parse($punchesBetweenShift->min('attendance_date'))->format('Y-m-d H:i:s');
                        } elseif ($punchesAfterEnd->isNotEmpty()) {
                            $startpunch = Carbon::parse($punchesAfterEnd->min('attendance_date'))->format('Y-m-d H:i:s');
                        }

                        // ✅ Determine endpunch
                        if ($punchesAfterEnd->isNotEmpty()) {
                            $endpunch = Carbon::parse($punchesAfterEnd->max('attendance_date'))->format('Y-m-d H:i:s');
                        } elseif ($punchesBetweenShift->isNotEmpty()) {
                            $endpunch = Carbon::parse($punchesBetweenShift->max('attendance_date'))->format('Y-m-d H:i:s');
                        } elseif ($punchesBeforeStart->isNotEmpty()) {
                            $endpunch = Carbon::parse($punchesBeforeStart->max('attendance_date'))->format('Y-m-d H:i:s');
                        }

                        // ✅ Gatepass override
                        if ($gatepass) {
                            $endpunch = $endhr->format('Y-m-d H:i:s');
                        }

                        $results[] = [
                            'org_id' => (int)$employee['org_id'],
                            'employee_id' => (int)$empid,
                            'shift' => $shift,
                            'work_date' => $date->format('Y-m-d'),
                            'start_punch' => $startpunch,
                            'end_punch' => $endpunch,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                foreach (array_chunk($results, 3000) as $chunk) {
                    PunchData::insert($chunk);
                    $totalInserted += count($chunk);
                }
            }
            // ⏱ Calculate total execution time
            $executionTime = round(microtime(true) - $startTime, 3);
            return redirect()->back()->with(
                'success',
                "✅ Attendance Pre Processed successfully completed.<br>" .
                    "Total inserted: <b>{$totalInserted}</b><br>" .
                    "Time taken: <b>{$executionTime} seconds</b>"
            );
        } else if ($request->title == 2) {
            $month = $request->month;
            $year  = $request->year;
            $startTime = microtime(true);

            $exists = PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->exists();
            if ($exists) {
                $deleteCount = PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->count();

                PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->delete();
                $lastId = DB::table('payroll_tools_punch_data')->max('id') ?? 0;
                $newAutoIncrement = $lastId + 1;

                DB::statement("ALTER TABLE payroll_tools_punch_data AUTO_INCREMENT = {$newAutoIncrement}");
            } else {
                return redirect()->back()->with('error', 'No punch data found for this month/year.');
            }

            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 3);

            return redirect()->back()->with('success', "Attendance Pre Process deleted successfully.Time taken: {$executionTime} seconds Total deleted: {$deleteCount}");
        } else if ($request->title == 3) {
            $month = $request->month;
            $year  = $request->year;
            $org_id = $request->org_id;
            $user_id = Auth::id();

            $exists = ProcessAttendence::whereMonth('work_date', $month)->whereYear('work_date', $year)->exists();
            if ($exists) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Attendance Process data already exists for this month/year.'
                    ]);
                }
                return redirect()->back()->with('error', 'Attendance Process data already exists for this month/year.');
            }

            // Create Job Status Record
            $jobStatus = JobStatus::create([
                'job_id' => (string) Str::uuid(),
                'user_id' => $user_id,
                'status' => 'pending',
                'progress' => 0,
                'message' => 'Attendance Process Job queued...'
            ]);

            ProcessAttendanceJob::dispatch($month, $year, $org_id, $user_id, $jobStatus->id);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Attendance Process job dispatched successfully. It will run in the background.",
                    'job_status_id' => $jobStatus->id
                ]);
            }

            return redirect()->back()->with('success', "✅ Attendance Process job dispatched successfully. It will run in the background. Job ID: {$jobStatus->id}");
        } else if ($request->title == 4) {
            $month = $request->month;
            $year  = $request->year;

            $startTime = microtime(true);
            $exists = ProcessAttendence::whereMonth('work_date', $month)
                ->whereYear('work_date', $year)
                ->exists();

            if ($exists) {
                $deletedCount = ProcessAttendence::whereMonth('work_date', $month)
                    ->whereYear('work_date', $year)
                    ->count();

                ProcessAttendence::whereMonth('work_date', $month)
                    ->whereYear('work_date', $year)
                    ->delete();

                $lastId = DB::table('payroll_tools_process_attendence')->max('id') ?? 0;
                $newAutoIncrement = $lastId + 1;
                DB::statement("ALTER TABLE payroll_tools_process_attendence AUTO_INCREMENT = {$newAutoIncrement}");

                $executionTime = round(microtime(true) - $startTime, 3);

                return redirect()->back()->with('success',"✅ Attendance Process deleted successfully." . "Total deleted rows: {$deletedCount}" . "Time taken: {$executionTime} seconds" );
            } else {
                return redirect()->back()->with('error', 'No attendance data found for this month/year.');
            }
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('payroll::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('payroll::edit');
    }

    
}
