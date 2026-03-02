<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\MaternityEntry;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Http\Requests\Tools\MaternityEntryRequest;

class MaternityEntryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.maternity-entry.view')->only('index');
        $this->middleware('permission:hris.maternity-entry.add')->only('store');
        $this->middleware('permission:hris.maternity-entry.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.maternity-entry.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = MaternityEntry::with(['employeeBasic:id,name,employee_id','designation:id,designation','department:id,department'])->select('id','joining_date','org_id','employee_id','designation_id','department_id','notice_date','application_date','leave_start_date','leave_end_date','leave_days','payment','payment_date','approved','is_active')->get();
        return view('hris::tools.maternityentry.index', compact('employees'));
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
    public function store(MaternityEntryRequest $request) {
        try {
            $employee = Employee::with(['employeePersonal:id,employee_id,marital_status,sex_code','designation:id,category_code'])->where('employee_id', (int)$request->employee_id)->select('id','joining_date','org_id','employee_id','name','designation_id','department_id')->first();
            if (!$employee) {
                return redirect()->back()->with('error', 'Employee not found');
            }

            if ($employee->employeePersonal->marital_status != 'M' || $employee->employeePersonal->sex_code != 'M') {
                return redirect()->back()->with('error', 'Employee is not married or not female');
            }

            $applied = MaternityEntry::where('employee_id', $employee->employee_id)->where('is_active', 1)->where('approved', 'Y')->count();
            if ($applied > 2) {
                return redirect()->back()->with('error', 'Employee has already applied for maternity leave 2 times');
            }

            $data = [
                'org_id' => $employee->org_id,
                'employee_id' => $employee->employee_id,
                'department_id' => $employee->department_id,
                'designation_id' => $employee->designation_id,
                'line' => $employee->line??0,
                'unit' => $employee->unit??0,
                'category' => $employee->designation->category_code,
                'joining_date' => $employee->joining_date,
                'notice_date' => $request->notice_date,
                'application_date' => $request->application_date,
                'possible_delivery_date' => $request->possible_delivery_date,
                'leave_start_date' => $request->leave_start_date,
                'leave_end_date' => $request->leave_end_date,
                'leave_days' => $request->leave_days,
                'is_active' => true,
            ];

            MaternityEntry::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Maternity entry created successfully');
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
    public function update(Request $request, $id) {
        $request->validate([
            'approved' => 'required',
            'payment' => 'required',
            'is_active' => 'required',
        ]);
        $data = $request->all();
        try {
            $maternityEntry = MaternityEntry::find($id);
            if (!$maternityEntry) {
                return redirect()->back()->with('error', 'Maternity entry not found');
            }
            if($data['approved'] == 'Y'){
                $data['payment_date'] = date('Y-m-d');
            }

            $maternityEntry->update($data);
            return redirect()->back()->with('success', 'Maternity entry updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Maternity entry update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $maternityEntry = MaternityEntry::find($request->id);
            if (!$maternityEntry) {
                return response()->json(['success' => false, 'message' => 'Maternity entry not found']);
            }

            if ($maternityEntry->approved == 'Y' || $maternityEntry->payment == 'Y') {
                return response()->json(['success' => false, 'message' => 'Maternity entry cannot be deleted']);
            }
            $maternityEntry->delete();
            return response()->json(['success' => true, 'message' => 'Maternity entry deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Maternity entry deletion failed: ' . $e->getMessage()]);
        }
    }
}
