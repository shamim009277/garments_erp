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
            $startTime = microtime(true);
            $today = Carbon::now()->format('Y-m-d');

            $exists = ProcessAttendence::whereMonth('work_date', $month)->whereYear('work_date', $year)->exists();
            if ($exists) {
                return redirect()->back()->with('error', 'Attendance Process data already exists for this month/year.');
            }

            $startdt = Carbon::parse($year . '-' . $month)->startOfMonth()->format('Y-m-d');
            $enddt   = Carbon::parse($startdt)->endOfMonth()->format('Y-m-d');

            $ramadandate = ['rm_seart_date' => '2026-01-01','rm_end_date' => '2026-01-15'];
            $baseshift = Shift::active()->select('shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get();
            $companyshift = CompanyWiseShift::active()->where('org_id', $request->org_id)->select('org_id', 'shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')->get();
            $ramadanshift = CompanyWiseRamadanShift::active()->where('org_id', $request->org_id)->get()->keyBy('shift');

            if ($baseshift->isEmpty() && $companyshift->isEmpty()) {
                return redirect()->back()->with('error', 'Please add shift. Common shift or company wise shift.');
            }

            $employees = Employee::where('org_id', $request->org_id)
                ->where(function($query) use($startdt, $enddt){
                    $query->where('reason', 'N')
                        ->orWhere('leaving_date', '>=', $startdt);
                })
                //->where('employee_id',5534)
                ->whereNotNull('refrerence_shift')
                ->select('id', 'org_id', 'employee_id', 'shifting_duty', 'refrerence_shift', 'ot_payable', 'mtreturn_date', 'joining_date', 'punch_category')
                ->orderBy('department_id')->orderBy('employee_id')
                ->get();

            $allempid = $employees->pluck('employee_id')->toArray();
            $shiftempids = $employees->where('shifting_duty', 'Y')->pluck('employee_id')->toArray();

            $assignshift = ShiftingList::whereIn('employee_id', $allempid)->whereMonth('date', $month)->whereYear('date', $year)->whereBetween('date', [$startdt, $enddt])->get();
            $caldatas = Calender::whereMonth('date', $month)->where('is_active', 1)->whereYear('date', $year)->whereBetween('date', [$startdt, $enddt])->select('date', 'year', 'month', 'holiday', 'public_holiday')->get();
            $leavedatas = DB::table('hris_database_leave_confirmation')->orderBy('employee_id', 'ASC')->orderBy('start_date', 'ASC')->whereBetween('start_date', [$startdt, $enddt])->orWhereBetween('end_date', [$startdt, $enddt])->select('employee_id', 'start_date', 'end_date', 'leave_type_id')->get();
            $allpunchrecords = PunchData::whereIn('employee_id', $allempid)->whereMonth('work_date', $month)->whereYear('work_date', $year)->whereBetween('work_date', [$startdt, $enddt])->get();

            //dd($allpunchrecords->pluck('employee_id')->unique()->values()->toArray());

            $excepholiday = ExceptionalHoliday::whereIn('employee_id', $shiftempids)
                    ->whereMonth('holiday_date', $month)
                    ->where('year', $year)
                    ->whereBetween('holiday_date', [$startdt, $enddt])
                    ->get();

            // 📊 Group punch, shift, gatepass by employee
            $allPunchGrouped = $allpunchrecords->groupBy('employee_id');
            $allShiftGrouped = $assignshift->groupBy('employee_id');
            $allExcepholidayGrouped = $excepholiday->groupBy('employee_id');

            $splitemps = $employees->chunk(200);
            $totalInserted = 0;

            foreach ($splitemps as $splitemp) {
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
                            $shift = $empShifts->where('date', $date)->first()->shift ?? $employee->refrerence_shift;
                            $shiftinfo = collect($companyshift)->where('shift', $shift)->first() ?? collect($baseshift)->where('shift', $shift)->first();
                            $calendardata = $caldatas->where('date', $date)->first();
                            $leavedata = $leavedatas->where('employee_id', $empid)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();
                            $punchdata = $empPunches->where('work_date', $date->format('Y-m-d'))->first();

                            if ($ramadandate && Carbon::parse($comdate)->between($ramadandate['rm_seart_date'],$ramadandate['rm_end_date'])){
                                $shiftinfo = $ramadanshift->get($shift)??$shiftinfo;
                            }

                            if (!$shiftinfo) continue;
                            if (!$calendardata) {
                                return redirect()->back()->with('error', 'No calendar data found for this date.');
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
                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => $leavedata->leave_type_id, 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                continue;
                            }else if($employee->punch_category == 1 && ($punchdata?->start_punch != null || $punchdata?->end_punch != null)){
                                $wwh = $wwhvalue;
                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => $punchdata->start_punch, 'end_punch' => $punchdata->end_punch, 'wwh' => $wwh, 'rwh' => $wwhvalue, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => $wwhvalue, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                            }
                            else if ($employee->punch_category == 3) {
                                $wwh = $wwhvalue;
                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => $wwhvalue, 'wwh' => 8, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => $wwhvalue, 'attn_type' => 'PR', 'is_late' => 'N', 'is_early_leave' => 'N', 'late_minutes' => 0, 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                            }
                            else if ($calendardata && $calendardata->public_holiday == 'Y') {
                                $wwh = $wwhvalue;
                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                continue;
                            } else if ($calendardata && $calendardata->holiday == 'Y') {
                                if($employee && $employee->shifting_duty == 'Y'){
                                    $excepholiday = $empExcepholiday->where('holiday_date',$date)->first();
                                    if($excepholiday && Carbon::parse($excepholiday->holiday_date)->format('Y-m-d') == $date){
                                        if ($employee && $employee->ot_payable == 'N') {
                                            $wwh = 11;
                                            $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                        } else if ($employee && $employee->ot_payable == 'Y') {
                                            $wwh = 11;
                                            $start_punch = $punchdata?->start_punch;
                                            $end_punch   = $punchdata?->end_punch;
                                            $totalhour = calculateTotalHours($start_punch, $end_punch);

                                            if ($totalhour > 0) {
                                                $othour = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => $totalhour, 'ot_hours' => $othour['hours'] ?? 0, 'ot_minutes' => $othour['minutes'] ?? 0, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                            } else {
                                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => 0, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                            }
                                        }
                                    }
                                }else{
                                    if ($employee && $employee->ot_payable == 'N') {
                                        $wwh = 8;
                                        $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                    } else if ($employee && $employee->ot_payable == 'Y') {
                                        $wwh = 8;
                                        $start_punch = $punchdata?->start_punch;
                                        $end_punch   = $punchdata?->end_punch;
                                        $totalhour = calculateTotalHours($start_punch, $end_punch);

                                        if ($totalhour > 0) {
                                            $othour = calculateActualHours($start_punch, $end_punch, $break_start, $break_end);
                                            $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => $totalhour, 'ot_hours' => $othour['hours'] ?? 0, 'ot_minutes' => $othour['minutes'] ?? 0, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                        } else {
                                            $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'shift' => $shift, 'wwh' => $wwh, 'rwh' => 0, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                        }
                                    }
                                }
                            } else if ($employee->punch_category == 2 && ($punchdata?->start_punch != null || $punchdata?->end_punch != null)) {
                                // check shifting duty 
                                $excepholiday = $empExcepholiday->where('holiday_date',$date)->first();
                                if ($employee && $employee->shifting_duty == 'Y' && ($excepholiday && Carbon::parse($excepholiday->holiday_date)->format('Y-m-d') == $date)) {
                                    $wwh = $wwhvalue;
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'HD', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
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
                                    // Always set PR if punches exist, even if 0 hours (e.g. very late)
                                    $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => $start_punch, 'end_punch' => $end_punch, 'rwh' => $rwh, 'wwh' => $wwh, 'ot_hours' => $othour, 'ot_minutes' => $otminutes, 'total_hours' => $totalhour, 'attn_type' => 'PR', 'is_late' => $islate, 'is_early_leave' => $isEarlyLeave, 'late_minutes' => $lateMinutes, 'early_minutes' => $earlyMinutes, 'short_minutes' => $shortMinutes, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                                }
                            }  else {
                                $wwh = 0;
                                $results[] = ['org_id' => $employee->org_id, 'employee_id' => $empid, 'shift' => $shift, 'work_date' => $date, 'start_punch' => null, 'end_punch' => null, 'rwh' => 0, 'wwh' => $wwh, 'ot_hours' => 0, 'ot_minutes' => 0, 'total_hours' => 0, 'attn_type' => 'AB', 'is_late' => 'N', 'late_minutes' => 0, 'is_early_leave' => 'N', 'early_minutes' => 0, 'short_minutes' => 0, 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id];
                            }
                        } catch (\Throwable $th) {
                            \Log::error('Process Attendence failed', [
                                'employee' => $employee,
                                'punchdata' => $punchdata,
                                'error' => $th->getMessage(),
                            ]);
                            continue;
                        }
                    }
                    // insert data
                    ProcessAttendence::insert($results);
                    $totalInserted += count($results);
                    $results = [];
                }
            }
            $executionTime = round(microtime(true) - $startTime, 3);
            return redirect()->back()->with('success', "✅ Attendance Processed successfully completed." . "Total inserted: {$totalInserted}<br>" . "Time taken: {$executionTime} seconds");
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
