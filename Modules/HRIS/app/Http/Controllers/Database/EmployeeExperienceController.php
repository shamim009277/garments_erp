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
            return redirect()->back()->with('success', 'Employee Experience created successfully');
        } catch (\Exception $e) {
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
            return redirect()->back()->with('success', 'Employee Experience updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Experience update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $experience = EmployeeExperience::findOrFail($request->id);
            $experience->delete();
            return redirect()->back()->with('success', 'Employee Experience deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee Experience deletion failed: ' . $e->getMessage());
        }
    }
}
