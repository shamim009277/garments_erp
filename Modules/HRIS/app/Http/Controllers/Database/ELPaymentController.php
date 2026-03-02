<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\ELPayment;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Http\Requests\Database\ELPaymentRequest;

class ELPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('hris::database.elpayment.index', compact('organizations', 'month', 'yearlist'));
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
    public function store(ELPaymentRequest $request) {
        if($request->title == 1){
            $year = $request->year;
            $month = $request->month;

            $basedate = Carbon::parse($year.'-'.$month)->endOfMonth()->format('Y-m-d');
            $startdate = Carbon::parse($basedate)->startOfMonth()->format('Y-m-d');
            $enddate = Carbon::parse($basedate)->endOfMonth()->format('Y-m-d');

            if($request->title == 1) {
                $prevchk = ELPayment::where('confirm','N')->where('base_date','!=',$basedate)->first();
                if($prevchk == null){
                    $notemplid = ELPayment::orderBy('employee_id','ASC')->where('year',$year)->pluck('employee_id');
                    //$employeeids = DB::table('pmis_database_employee_basic')->orderBy('employee_id','ASC')->whereNotIn('DepartmentID',[1,50])->whereNotIn('EmployeeID',$notemplid)->where('ReasonID','N')->where('Salaried','Y')->where('JoiningDate','<=',$enddate)->orWhere('LeavingDate','>',$startdate)->whereNotIn('DepartmentID',[1,50])->whereNotIn('EmployeeID',$notemplid)->where('Salaried','Y')->where('JoiningDate','<=',$enddate)->pluck('EmployeeID');

                    $employees = DB::table('hr_database_elcalculation as elcalc')
                        ->where('elcalc.Year',$year)
                        ->whereNotIn('elcalc.employee_id',$notemplid)
                        ->leftJoin('hris_database_employee_basic as basic','elcalc.employee_id','=','basic.employee_id')
                        ->whereMonth('elcalc.month','<=',$month)
                        ->leftJoin('hris_database_employee_salary as salary','elcalc.employee_id','=','salary.employee_id')
                        ->leftJoin('hris_setup_designations','basic.designation_id','=','hris_setup_designations.id')
                        ->select('basic.employee_id','elcalc.earned_days','basic.designation_id','basic.designation_id','basic.line','basic.unit','basic.joining_date','basic.reason','basic.leaving_date','salary.gross_salary','salary.basic','hris_setup_designations.category_code')
                        ->orderBy('basic.employee_id','ASC')
                        ->get();

                    $lastid = ELPayment::orderBy('id','DESC')->pluck('id')->first()+1;
                    foreach($employees as $employee) {
                        $paydays = floor(($employee->earned_days/100)*50);
                        $rate = round($employee->gross_salary/30, 2);
                        $amount = round($paydays*$rate);

                        $elpayment = new ELPayment();
                        $elpayment->save();

                        $lastid++;
                    }
                }else{

                }
            }elseif($request->title == 2){

            }elseif($request->title == 3){

            }
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
