<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Http\Requests\Setup\EmpGatepassPurposeRequest;
use App\Traits\ToggleStatus;

class EmpGatepassPurposeController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.gatepass-purpose.view')->only('index');
        $this->middleware('permission:hris.gatepass-purpose.add')->only('store');
        $this->middleware('permission:hris.gatepass-purpose.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.gatepass-purpose.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purposes = EmpGatepassPurpose::all();
        return view('hris::setup.purpose.index', compact('purposes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpGatepassPurposeRequest $request)
    {
        try {
            EmpGatepassPurpose::create($request->validated());
            return redirect()->back()->with('success', 'Gate Pass Purpose created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gate Pass Purpose creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpGatepassPurposeRequest $request, $id) {
        try {
            $purpose = EmpGatepassPurpose::findOrFail($id);
            $purpose->update($request->validated());
            return redirect()->back()->with('success', 'Gate Pass Purpose updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gate Pass Purpose update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            EmpGatepassPurpose::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Gate Pass Purpose deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gate Pass Purpose deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, EmpGatepassPurpose::class);
    }
}
