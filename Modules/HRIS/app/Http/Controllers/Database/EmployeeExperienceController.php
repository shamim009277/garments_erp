<?php

namespace Modules\HRIS\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Database\EmployeeExperience;
use Modules\HRIS\Http\Requests\Database\EmployeeExperienceRequest;

class EmployeeExperienceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.employee.experienceadd')->only('store');
        $this->middleware('permission:hris.employee.experienceedit')->only(['update']);
        $this->middleware('permission:hris.employee.experiencedelete')->only(['destroy']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeExperienceRequest $request) {
        try {
            EmployeeExperience::create($request->validated());
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 5])->with('success', 'Employee Experience created successfully');
        } catch (\Exception $e) {
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            if($employee){
                return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 5])->with('error', 'Employee Experience creation failed: ' . $e->getMessage());
            }
            return redirect()->back()->with('error', 'Employee Experience creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeExperienceRequest $request, $id) {
        try {
            $experience = EmployeeExperience::findOrFail($id);
            $experience->update($request->validated());
            $employee = Employee::where('employee_id', $experience->employee_id)->first();
            return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 5])->with('success', 'Employee Experience updated successfully');
        } catch (\Exception $e) {
            $experience = EmployeeExperience::find($id);
            if($experience){
                $employee = Employee::where('employee_id', $experience->employee_id)->first();
                if($employee){
                    return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 5])->with('error', 'Employee Experience update failed: ' . $e->getMessage());
                }
            }
            return redirect()->back()->with('error', 'Employee Experience update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $experience = EmployeeExperience::findOrFail($request->id);
            $employeeId = $experience->employee_id;
            $experience->delete();
            $employee = Employee::where('employee_id', $employeeId)->first();
            return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 5])->with('success', 'Employee Experience deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Experience deletion failed: ' . $e->getMessage());
        }
    }
}
