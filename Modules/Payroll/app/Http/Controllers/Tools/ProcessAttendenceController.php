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

        $start_date = '2026-01-01';
        $end_date = '2026-01-31';
        // $datas = ProcessAttendence::where('org_id', 1)->whereBetween('work_date', [$start_date, $end_date])->get();
        // $allempids = $datas->pluck('employee_id')->unique()->toArray();

        // $employeeTotals = ProcessAttendence::where('org_id', 1)
        //     ->whereBetween('work_date', [$start_date, $end_date])
        //     ->select('employee_id', DB::raw('COUNT(*) as total_data'))
        //     ->groupBy('employee_id')
        //     ->pluck('total_data', 'employee_id')
        //     ->toArray();


        // $employeeWiseCount = ProcessAttendence::where('org_id', 1)
        //     ->whereBetween('work_date', [$start_date, $end_date])
        //     ->groupBy('employee_id')
        //     ->selectRaw('employee_id, COUNT(*) as total')
        //     ->pluck('total', 'employee_id')
        //     ->toArray();

        // $data = ProcessAttendence::where('org_id', 1)
        //     ->whereBetween('work_date', [$start_date, $end_date])
        //     ->get();

        //dd($employeeWiseCount,$data);

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
            $pre_date = Carbon::parse($request->date)->format('Y-m-d');
            $month = Carbon::parse($pre_date)->format('m');
            $year  = Carbon::parse($pre_date)->format('Y');
            $start_date = Carbon::parse($pre_date)->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::parse($pre_date)->endOfMonth()->format('Y-m-d');
            $org_id = $request->org_id;

            // ✅ Check if punch data already exists for this month
            $exists = PunchData::where('org_id', $request->org_id)->whereBetween('work_date', [$start_date, $end_date])->where('org_id', $request->org_id)->exists();
            if ($exists) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Pre process attendance already exists for this month.'
                    ]);
                }
                return redirect()->back()->with('error', 'Pre process attendance already exists for this month.');
            }

            // Create Job Status Record
            $jobStatus = JobStatus::create([
                'job_id' => (string) Str::uuid(),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'progress' => 0,
                'message' => 'Pre-Process Attendance Job queued...'
            ]);

            PreProcessAttendanceJob::dispatch($request->date, $request->org_id, Auth::id(), $jobStatus->id);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Pre-Process Attendance job dispatched successfully. It will run in the background.",
                    'job_status_id' => $jobStatus->id
                ]);
            }

            return redirect()->back()->with('success', "✅ Attendance Pre Process job dispatched successfully. Job ID: {$jobStatus->id}");
        } else if ($request->title == 2) {
            $month = $request->month;
            $year  = $request->year;
            $org_id = $request->org_id;
            $startTime = microtime(true);

            $exists = PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $org_id)->exists();
            if ($exists) {
                $deleteCount = PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $org_id)->count();
                PunchData::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $org_id)->delete();
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

            $exists = ProcessAttendence::whereMonth('work_date', $month)->whereYear('work_date', $year)->where('org_id', $org_id)->exists();
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
            $org_id = $request->org_id;

            $startTime = microtime(true);
            $exists = ProcessAttendence::whereMonth('work_date', $month)
                ->whereYear('work_date', $year)
                ->where('org_id', $org_id)
                ->exists();

            if ($exists) {
                $deletedCount = ProcessAttendence::whereMonth('work_date', $month)
                    ->whereYear('work_date', $year)
                    ->where('org_id', $org_id)
                    ->count();

                ProcessAttendence::whereMonth('work_date', $month)
                    ->whereYear('work_date', $year)
                    ->where('org_id', $org_id)
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
