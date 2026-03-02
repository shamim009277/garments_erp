<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\EmpGatepassReason;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Http\Requests\Setup\EmpGatepassReasonRequest;

class EmpGatepassReasonController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.gate-pass-reason.view')->only('index');
        $this->middleware('permission:hris.gate-pass-reason.add')->only('store');
        $this->middleware('permission:hris.gate-pass-reason.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.gate-pass-reason.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reasons = EmpGatepassReason::with(['purpose:id,purpose'])->get();
        $purposes = EmpGatepassPurpose::active()->pluck('purpose', 'id');
        return view('hris::setup.reason.index', compact('reasons', 'purposes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpGatepassReasonRequest $request) {
        try {
            EmpGatepassReason::create($request->validated());
            return redirect()->back()->with('success', 'Gate Pass Reason created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gate Pass Reason creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpGatepassReasonRequest $request, $id) {
        try {
            $reason = EmpGatepassReason::findOrFail($id);
            $reason->update($request->validated());
            return redirect()->back()->with('success', 'Gate Pass Reason updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gate Pass Reason update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            EmpGatepassReason::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Gate Pass Reason deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gate Pass Reason deletion failed: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, EmpGatepassReason::class);
    }
}
