<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDesignation;
use Modules\HRIS\Http\Requests\Setup\DesignationRequest;
use App\Traits\ToggleStatus;

class DesignationController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDesignations = ParentDesignation::active()->pluck('designation', 'id');
        $categories = EmployeeCategory::active()->pluck('category', 'category_code');
        $designations = Designation::with('parentDesignation:id,designation')->latest()->get();
        return view('hris::setup.designation.index', compact('parentDesignations', 'categories', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request) {
        try {
            $designation = Designation::create($request->validated());
            return redirect()->route('hris.setup.designations.index')->with('success', 'Designation created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create designation: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationRequest $request, $id) {
        try {
            $designation = Designation::findOrFail($id);
            $designation->update($request->validated());
            return redirect()->route('hris.setup.designations.index')->with('success', 'Designation updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update designation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Designation::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Designation deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Designation deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Designation::class);
    }
}
