<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Http\Requests\Setup\DepartmentRequest;
use App\Traits\ToggleStatus;

class DepartmentController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('parentDepartment:id,department')->latest()->get();
        $parentDepartments = ParentDepartment::active()->pluck('department', 'id');
        return view('hris::setup.department.index', compact('departments', 'parentDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request) {
        try {
            $department = Department::create($request->validated());
            return redirect()->route('hris.setup.departments.index')->with('success', 'Department created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create department: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, $id) {
        try {
            $department = Department::findOrFail($id);
            $department->update($request->validated());
            return redirect()->route('hris.setup.departments.index')->with('success', 'Department updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update department: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Department::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Department deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Department deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Department::class);
    }
}
