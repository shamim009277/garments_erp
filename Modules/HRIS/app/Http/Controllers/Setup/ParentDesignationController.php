<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\ParentDesignation;
use Modules\HRIS\Http\Requests\Setup\ParentDesignationRequest;
use App\Traits\ToggleStatus;

class ParentDesignationController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDesignations = ParentDesignation::all();
        return view('hris::setup.parentdesignation.index', compact('parentDesignations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParentDesignationRequest $request)
    {
        try {
            ParentDesignation::create($request->validated());
            return redirect()->route('hris.setup.parentdesignations.index')->with('success', 'Parent Designation created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create parent designation: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ParentDesignationRequest $request, $id)
    {
        try {
            ParentDesignation::findOrFail($id)->update($request->validated());
            return redirect()->route('hris.setup.parentdesignations.index')->with('success', 'Parent Designation updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update parent designation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            ParentDesignation::findOrFail($request->id)->delete();
            return redirect()->route('hris.setup.parentdesignations.index')->with('success', 'Parent Designation deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete parent designation: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, ParentDesignation::class);
    }
}
