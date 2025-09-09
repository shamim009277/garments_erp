<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\LeaveReason;
use Modules\HRIS\Models\Database\LeaveApplication;
use Modules\HRIS\Models\Setup\LeaveClassification;
use Modules\HRIS\Http\Requests\Database\LeaveApplicationRequest;
use App\Traits\LeaveBalance;

class LeaveApplicationController extends Controller
{
    use LeaveBalance;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date=Carbon::now()->format('Y-m-d');
        $leave_types = LeaveClassification::pluck('signification','code');
        return view('hris::database.leaveapplication.index',compact('date','leave_types'));
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
    public function store(LeaveApplicationRequest $request) {
         try {
            $leaveApplication = LeaveApplication::create($request->validated());
            return redirect()->route('hris.database.leave-application.index')->with('success', 'Leave Application created successfully');
         } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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


    public function getLeaveInfo(Request $request)
    {
        $employee = Employee::with(['designation:id,designation','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate'])
                  ->where('employee_id', (int)$request->employee_id)
                  ->select('id','employee_id','name','designation_id','department_id','joining_date','photo')
                  ->first();

        $leaveBalance = $this->calculateAccrualUpToToday($request->employee_id);

        return response()->json([
           'employee' => $employee,
           'leaveBalance' => $leaveBalance,
        ]);
    }

    public function getLeaveReason(Request $request)
    {
        $leave_reason = LeaveReason::active()->whereJsonContains('classification_id', $request->leave_type)->pluck('reason','id');
        return response()->json($leave_reason);
    }
}
