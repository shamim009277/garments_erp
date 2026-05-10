<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\DepartureReason;

class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departurereasons = DepartureReason::active()->pluck('reason', 'reason_short_name');
        return view('hris::tools.departure.index', compact('departurereasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required|exists:hris_database_employee_basic,employee_id',
            'reason' => 'required',
            'salaried' => 'required',
            'leaving_date' => 'required|date',
            'leaving_note' => 'required|string|max:200',
            'mtreturn_date' => 'nullable|date',
        ]);
        try {
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            if(Auth::user()->access_id != $employee->org_id && Auth::user()->access_id != 0){
                return redirect()->back()->with('error', 'You are not authorized to depart this employee');
            }

            if($request->reason == 'N') {
                return redirect()->back()->with('error', 'Departure reason is not valid');
            }else if($request->reason == 'M') {
                $employee->mtreturn_date = $request->mtreturn_date;
            }
            $employee->reason = $request->reason;
            $employee->salaried = $request->salaried;
            $employee->leaving_date = $request->leaving_date;
            $employee->leaving_note = $request->leaving_note;
            $employee->save();
            return redirect()->route('hris.tools.departure.index')->with('success', 'Departure created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create departure: ' . $th->getMessage());
        }
    }


    public function employeeInfo(Request $request) {
        $employee = Employee::with(['designation:id,designation','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate'])
                ->where('employee_id', (int)$request->employee_id)
                ->select('id','employee_id','name','designation_id','department_id','joining_date','photo','signature','reason','salaried','leaving_date','leaving_note','mtreturn_date','org_id')
                ->first();
        return response()->json($employee);
    }
}
