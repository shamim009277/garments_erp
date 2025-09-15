<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Modules\HRIS\Http\Requests\Setup\ParentDepartmentRequest;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Illuminate\Http\Request;
use App\Traits\ToggleStatus;

class ParentDepartmentController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.parent-department.view')->only('index');
        $this->middleware('permission:hris.parent-department.add')->only('store');
        $this->middleware('permission:hris.parent-department.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.parent-department.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDepartments = ParentDepartment::active()->get();
        return view('hris::setup.parentdepartment.index', compact('parentDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParentDepartmentRequest $request)
    {
        $parentDepartment = ParentDepartment::create($request->validated());
        return redirect()->route('hris.setup.parentdepartments.index')->with('success', 'Parent Department created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParentDepartmentRequest $request, $id)
    {
        $parentDepartment = ParentDepartment::findOrFail($id);
        $parentDepartment->update($request->validated());
        return redirect()->route('hris.setup.parentdepartments.index')->with('success', 'Parent Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            ParentDepartment::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Parent Department deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Parent Department deletion failed: ' . $e->getMessage()]);
        }
    }
    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, ParentDepartment::class);
    }
}
