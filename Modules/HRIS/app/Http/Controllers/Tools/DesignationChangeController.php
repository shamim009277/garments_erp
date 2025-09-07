<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Database\EmployeeBangla;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Modules\HRIS\Models\Tools\DesignationChange;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Http\Requests\Tools\DesignationChangeRequest;

class DesignationChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $designations = Designation::where('is_active', 1)->pluck('designation', 'id');
        $departments = Department::where('is_active', 1)->pluck('department', 'id');
        $organizations = Organization::where('is_active', 1)->pluck('short_name', 'id');
        return view('hris::tools.designationchange.index', compact('employees', 'designations', 'departments', 'organizations'));
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
    public function store(DesignationChangeRequest $request) {

        //check both are same
        if ($request->designation_id == $request->new_designation_id && $request->department_id == $request->new_department_id && $request->org_id == $request->new_org_id) {
            return redirect()->back()->with('error', 'New designation, department, and organization must be different from the old ones');
        }

        DB::beginTransaction();
        try {
            $designationChange = DesignationChange::create([
                'date'                => now()->format('Y-m-d'),
                'employee_id'         => $request->employee_id,
                'designation_id'      => $request->new_designation_id,
                'department_id'       => $request->new_department_id,
                'org_id'              => $request->new_org_id,
                'old_designation_id'  => $request->designation_id,
                'old_department_id'   => $request->department_id,
                'old_org_id'          => $request->org_id,
                'reason'              => $request->reason,
                'created_by'          => Auth::id(),
                'updated_by'          => Auth::id(),
            ]);

            //update employee
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            if (!$employee) {
                return redirect()->back()->with('error', 'Employee not found');
            }
            $employee->designation_id = $request->new_designation_id;
            $employee->department_id = $request->new_department_id;

            if($request->new_org_id != $request->org_id){
                $employee->org_id = $request->new_org_id;
            }
            $employee->save();

            if($request->new_org_id != $request->org_id){
                //update employee personal
                $employeePersonal = EmployeePersonal::where('employee_id', $request->employee_id)->first();
                if ($employeePersonal) {
                    $employeePersonal->org_id = $request->new_org_id;
                    $employeePersonal->save();
                }

                //update employee salary
                $employeeSalary = EmployeeSalary::where('employee_id', $request->employee_id)->first();
                if ($employeeSalary) {
                    $employeeSalary->org_id = $request->new_org_id;
                    $employeeSalary->save();
                }

                //update employee bangla
                $employeeBangla = EmployeeBangla::where('employee_id', $request->employee_id)->first();
                if ($employeeBangla) {
                    $employeeBangla->org_id = $request->new_org_id;
                    $employeeBangla->save();
                }
            }
            DB::commit();
            return redirect()->route('hris.tools.designationchange.index')->with('success', 'Designation change created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create designation change: ' . $th->getMessage());
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
