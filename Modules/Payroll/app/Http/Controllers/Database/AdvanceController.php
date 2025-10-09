<?php

namespace Modules\Payroll\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\Employee;
use Modules\Payroll\Models\Database\Advance;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Modules\Payroll\Http\Requests\Database\AdvanceRequest;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advances = Advance::with(['employee:id,employee_id,name'])->active()->where('full_refund', 'N')->get();
        return view('payroll::database.advance.index', compact('advances'));
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
    public function store(AdvanceRequest $request) {
        try {
            $rfnddate = Carbon::parse($request->refund_start_date)->startOfMonth()->format('Y-m-d');
            $enddate = Carbon::parse($request->refund_start_date)->endOfMonth()->format('Y-m-d');
            $empchk = Employee::where('employee_id',(int)$request->employee_id)->where('reason','N')->where('salaried','Y')->where('joining_date','<=',$enddate)->orWhere('leaving_date','>',$rfnddate)->where('employee_id',(int)$request->employee_id)->where('salaried','Y')->where('joining_date','<=',$enddate)->first();
            $empsal = EmployeeSalary::where('employee_id', (int)$request->employee_id)->value('gross_salary');

            $exist = Advance::where('employee_id',(int)$request->employee_id)->where('full_refund','N')->first();

            if($exist){
                return redirect()->back()->with('error', 'Employee already have advance');
            }else if($empsal < $request->installment_size){
                return redirect()->back()->with('error', 'Employee salary is less than installment size');
            }

            if($empchk && $empsal){
                $data = $request->all();
                $data['org_id'] = $empchk->org_id;
                $data['department_id'] = $empchk->department_id;
                $data['designation_id'] = $empchk->designation_id;
                $data['line_id'] = $empchk->line_id??0;
                $data['unit_id'] = $empchk->unit_id??0;
                $data['balance_amount'] = $request->advance_amount;

                $advance = Advance::create($data);

            }else{
                return redirect()->back()->with('error', 'Employee not found or not salaried or not in service');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong '.$th->getMessage());
        }

        return redirect()->back()->with('success', 'Advance added successfully');
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function employeeInfo(Request $request){
        $employee = Employee::with(['designation:id,designation','department:id,department'])
            ->where('employee_id', (int)$request->employee_id)
            ->select('id','employee_id','name','designation_id','department_id')
            ->first();
        return response()->json($employee);
    }
}
