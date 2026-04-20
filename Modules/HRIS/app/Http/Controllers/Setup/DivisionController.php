<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Division;
use Modules\HRIS\Http\Requests\Setup\DivisionRequest;
use App\Traits\ToggleStatus;

class DivisionController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.divisions.view')->only('index');
        $this->middleware('permission:hris.divisions.add')->only('store');
        $this->middleware('permission:hris.divisions.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.divisions.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::all();
        return view('hris::setup.division.index', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DivisionRequest $request) {
        try {
            Division::create($request->validated());
            return redirect()->route('hris.setup.divisions.index')->with('success', 'Division created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create division: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DivisionRequest $request, $id) {
        try {
            $division = Division::findOrFail($id);
            $division->update($request->validated());
            return redirect()->route('hris.setup.divisions.index')->with('success', 'Division updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update division: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Division::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Division deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Division deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Division::class);
    }
}
