<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\EmployeeTraining;
use Modules\HRIS\Http\Requests\Database\EmployeeTrainingRequest;

class EmployeeTrainingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.employee.trainingadd')->only('store');
        $this->middleware('permission:hris.employee.trainingedit')->only(['update']);
        $this->middleware('permission:hris.employee.trainingdelete')->only(['destroy']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeTrainingRequest $request) {
        try {
            EmployeeTraining::create($request->validated());
            return redirect()->back()->with('success', 'Employee Training created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Training creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeTrainingRequest $request, $id) {
        try {
            $employeeTraining = EmployeeTraining::findOrFail($id);
            $employeeTraining->update($request->validated());
            return redirect()->back()->with('success', 'Employee Training updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Training update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            EmployeeTraining::findOrFail($request->id)->delete();
            return redirect()->back()->with('success', 'Employee Training deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Training deletion failed: ' . $e->getMessage());
        }
    }
}
