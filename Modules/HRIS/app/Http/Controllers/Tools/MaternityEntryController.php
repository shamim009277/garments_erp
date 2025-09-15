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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hris::tools.maternityentry.index');
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
            $employee = Employee::with(['employeePersonal:id,marital_status,sex_code','designation:id,category_code'])->where('employee_id', (int)$request->employee_id)->select('id','employee_id','name','designation_id','department_id')->first();
            if (!$employee) {
                return redirect()->back()->with('error', 'Employee not found');
            }

            if ($employee->employeePersonal->marital_status != 'M' || $employee->employeePersonal->sex_code != 'M') {
                return redirect()->back()->with('error', 'Employee is not married or not female');
            }

            $data = [
                'org_id' => $employee->org_id,
                'employee_id' => $employee->id,
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
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
