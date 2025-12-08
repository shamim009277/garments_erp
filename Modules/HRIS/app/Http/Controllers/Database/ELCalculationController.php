<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\ELPayment;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Database\ELCalculation;

class ELCalculationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.el-calculation.view')->only('index');
        $this->middleware('permission:hris.el-calculation.add')->only('store');
        $this->middleware('permission:hris.el-calculation.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.el-calculation.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('hris::database.elcalculation.index', compact('organizations', 'month', 'yearlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if($request->title == 1){
            $year = $request->year;
            $month = $request->month;
            $org_id = $request->org_id;

            $basedate = Carbon::parse($year.'-'.$month)->endOfMonth()->format('Y-m-d');
            $startbasedate = Carbon::parse($basedate)->startOfMonth()->format('Y-m-d');
            $startdate = Carbon::parse($basedate)->subYears(1)->startOfMonth()->format('Y-m-d');
            $enddate = Carbon::parse($basedate)->subYears(1)->endOfMonth()->format('Y-m-d');
            $subbasedate = Carbon::parse($basedate)->subYears(1)->addDays(1)->format('Y-m-d');

            dd($basedate, $startbasedate, $startdate, $enddate, $subbasedate);

            $check = ELCalculation::where('org_id',$org_id)->where('year',$year)->where('month',$month)->first();

            if($check == null){
                $existsids = ELCalculation::where('org_id',$org_id)->where('base_date','>',$enddate)->pluck('employee_id')->toArray();

                $baseexistid = DB::table('hris_database_employee_basic as basic')
                    ->leftJoin('hris_database_elcalculation as calculation', 'basic.employee_id', '=', 'calculation.employee_id')
                    ->where('basic.org_id', $org_id)
                    ->where('calculation.month', $month)
                    ->where('calculation.year', $year-1)
                    ->whereNotIn('basic.employee_id', $existsids)
                    ->where(function($query) use ($startbasedate) {
                        $query->where('basic.reason', 'N')
                            ->orWhere('basic.leaving_date', '>', $startbasedate);
                    })
                    ->orderBy('basic.employee_id', 'ASC')
                    ->pluck('basic.employee_id');

                dd($baseexistid);

                //dd($employee);
                $employeeids = DB::table('hris_database_employee_basic')
                    ->where('org_id', $org_id)
                    ->whereNotIn('employee_id', $existsids)
                    ->whereNotIn('employee_id', $baseexistid)
                    ->whereMonth('joining_date', $month)
                    ->where(function($query) use ($startbasedate) {
                        $query->where('reason', 'N')
                            ->orWhere('leaving_date', '>', $startbasedate);
                    })
                    ->orderBy('employee_id', 'ASC')
                    ->pluck('employee_id');

                $employees = DB::table('hris_database_employee_basic as basic')
                        ->whereIn('basic.employee_id',$employeeids)
                        ->leftJoin('hris_setup_designations','basic.designation_id','=','hris_setup_designations.id')
                        ->select('basic.employee_id','basic.org_id','basic.department_id','basic.designation_id','basic.joining_date','hris_setup_designations.category_code','basic.line','basic.unit')
                        ->orderBy('basic.employee_id','ASC')
                        ->get();

                //dd($employees);

                $eldatas = ELCalculation::orderBy('year','DESC')->orderBy('employee_id','ASC')->where('year',$year-1)->get();
                $elcalcdata = collect($eldatas)->unique('employee_id')->all();

                $elpaydatas = ELPayment::orderBy('year','DESC')->orderBy('employee_id','ASC')->where('year',$year-1)->get();
                $elpaydays = collect($elpaydatas)->unique('employee_id')->all();

                //normal employee
                $splitemps = collect($employees)->chunk(150)->toArray();

                foreach($splitemps as $splitemp){
                    $empids = collect($splitemp)->sortBy('employee_id')->pluck('employee_id');
                    $attndata = DB::table('payroll_tools_process_attendence')->orderBy('employee_id','ASC')->orderBy('work_date','ASC')->whereIn('employee_id',$empids)->whereBetween('work_date',[$subbasedate,$basedate])->whereNotIn('attn_type',['LWOP','AB'])->get();

                    $elenjoydata = DB::table('hris_database_employee_basic')
                            ->whereIn('hris_database_employee_basic.employee_id',$empids)
                            ->select('hris_database_employee_basic.employee_id',
                                    DB::raw("(SELECT SUM(DATEDIFF(end_date,start_date)+1)
                                    FROM
                                        hris_database_leave_confirmation
                                            WHERE employee_id = hris_database_employee_basic.employee_id
                                            AND ((start_date BETWEEN '$subbasedate' AND '$basedate')
                                            OR (end_date BETWEEN '$subbasedate' AND '$basedate')
                                            OR (start_date < '$subbasedate' AND end_date > '$basedate'))
                                            AND leave_type_id = 'EL') as EXEL"))
                            ->orderBy('hris_database_employee_basic.employee_id','ASC')
                            ->get();

                    $results = [];
                    foreach($splitemp as $employee) {
                        $empid = $employee->employee_id;
                        $presentdays = collect($attndata)->where('employee_id',$empid)->count();
                        $elwd = 18;
                        $elmax = 40;
                        $earndays = floor($presentdays/$elwd);
                        $elenjoy = collect($elenjoydata)->where('employee_id',$empid)->pluck('EXEL')->first();

                        $paydays = collect($elpaydays)->where('EmployeeID',$empid)->pluck('PayDays')->first();

                        $enjoylv = ($elenjoy ? $elenjoy : 0) + ($paydays ? $paydays : 0);
                        $elcalc = collect($elcalcdata)->where('employee_id',$empid)->first();

                        if($elcalc){
                            $prevdays = ($elcalc->previous_days + $elcalc->earned_days) - $enjoylv;
                            $leavedays = 0;
                        }else{
                            $prevdays = 0;
                            $leavedays = $enjoylv;
                        }
                        $prevdays = ($prevdays + $earndays) >= $elmax ? $elmax - $earndays : $prevdays;

                        array_push($results,[
                            'org_id' => $org_id,
                            'employee_id' => $empid,
                            'department_id' => $employee->department_id,
                            'designation_id' => $employee->designation_id,
                            'line' => $employee->line,
                            'unit' => $employee->unit,
                            'category' => $employee->category_code,
                            'month' => $month,
                            'year' => $year,
                            'joining_date' => $employee->joining_date,
                            'base_date' => $basedate,
                            'present_days' => $presentdays,
                            'earned_days' => $earndays,
                            'previous_days' => $prevdays,
                            'confirm' => 0,
                            'is_active' => 1,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id()
                        ]);
                    }
                }
            }else{
                return redirect()->back()->with('error', 'EL Calculation already exists for this organization, year and month');
            }

            dd($basedate, $startbasedate, $startdate, $enddate, $subbasedate);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
