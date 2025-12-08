<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmpGatePass;
use Modules\HRIS\Models\Setup\EmpGatepassReason;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Http\Requests\Database\EmpGatePassRequest;

class EmpGatePassController extends Controller
{
   /*  function __construct()
    {
        $this->middleware('permission:hris.employee-gatepass.view')->only('index','getEmployee');
        $this->middleware('permission:hris.employee-gatepass.add')->only('store');
        $this->middleware('permission:hris.employee-in.view')->only('getEmployeeIn');
        $this->middleware('permission:hris.employee-in.add')->only('getEmployeeInUpdate');
        $this->middleware('permission:hris.employee-out.view')->only('getEmployeeOut');
        $this->middleware('permission:hris.employee-out.add')->only('getEmployeeOutUpdate');
    } */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        $purposes = EmpGatepassPurpose::active()->pluck('purpose', 'id');
        return view('hris::database.gatepass.index', compact('date', 'purposes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpGatePassRequest $request) {
        $approvedis = DB::table('hris_settings_employee_gatepass_approve')->where('user_id', Auth::user()->id)->pluck('employee_id')->toArray();
        if (!in_array($request->employee_id, $approvedis)) {
            return redirect()->back()->with('error', 'You are not authorized to approve this employee gate pass.');
        }
        //check if employee gate pass already exists
        $overlapExists = DB::table('hris_database_employee_gatepass')
            ->where('employee_id', $request->employee_id)
            ->where('date', $request->date)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->start_time);
                      })
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<=', $request->end_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($overlapExists) {
            return redirect()->back()->with('error', 'This time slot overlaps with an existing gatepass.');
        }

        //check every day max 3 gatepass
        if ($request->type_id == 1) {
            $countTypeOne = DB::table('hris_database_employee_gatepass')
                ->where('employee_id', $request->employee_id)
                ->where('date', $request->date)
                ->where('type_id', 1)
                ->count();

            if ($countTypeOne >= 3) {
                return redirect()->back()->with('error', 'Gate Pass Quota For Today is Over. You have already taken '. $countTypeOne . ' gate pass for today.');
            }
        }

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['approved_by'] = Auth::id();
            $data['employee_id'] = (int)$request->employee_id;
            EmpGatePass::create($data);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create employee gate pass: ' . $th->getMessage());
        }
        DB::commit();
        return redirect()->back()->with('success', 'Employee gate pass created successfully');
    }

    public function getReasons(Request $request) {
        $reasons = EmpGatepassReason::where('purpose_id', $request->purpose_id)->pluck('reason', 'id');
        return response()->json($reasons);
    }

    public function getEmployeeIn(){
        $date = Carbon::now()->format('Y-m-d');
        $gatePasses = EmpGatePass::with(['employee:employee_id,name,photo', 'purpose:id,purpose', 'reason:id,reason','department:id,department','designation:id,designation','approvedBy:id,name'])->where('type_id', 1)->whereNotNull('actual_out')->where('actual_in', null)->where('date', $date)->get();
        return view('hris::database.gatepass.in', compact('date', 'gatePasses'));
    }

    public function getEmployeeOut(){
        $date = Carbon::now()->format('Y-m-d');
        $gatePasses = EmpGatePass::with(['employee:employee_id,name,photo', 'purpose:id,purpose', 'reason:id,reason','department:id,department','designation:id,designation','approvedBy:id,name'])->where('actual_out', null)->where('date', $date)->get();
        return view('hris::database.gatepass.out', compact('date', 'gatePasses'));
    }

    public function getEmployeeOutUpdate(Request $request){
        DB::beginTransaction();
        try {
            $time = Carbon::now()->format('H:i');
            EmpGatePass::where('id', $request->id)->update(['actual_out' => $time]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to update employee gate pass: ' . $th->getMessage()]);
        }
        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Employee gate pass updated successfully']);
    }

    public function getEmployeeInUpdate(Request $request){
        DB::beginTransaction();
        try {
            $time = Carbon::now()->format('H:i');
            EmpGatePass::where('id', $request->id)->update(['actual_in' => $time]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Failed to update employee gate pass: ' . $th->getMessage()]);
        }
        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Employee gate pass updated successfully']);
    }

    public function getEmployee(Request $request){
        $approvedis = DB::table('hris_settings_employee_gatepass_approve')->where('user_id', Auth::user()->id)->pluck('employee_id')->toArray();
        if (!in_array((int)$request->employee_id, $approvedis)) {
            return response()->json(['status' => 'error', 'message' => 'You are not authorized to approve this employee gate pass.']);
        }else{
            $employee = Employee::with(['designation:id,designation','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate'])
                  ->where('employee_id', (int)$request->employee_id)
                  ->select('id','employee_id','name','designation_id','department_id','joining_date','photo')
                  ->first();
            return response()->json($employee);
        }
    }

}
