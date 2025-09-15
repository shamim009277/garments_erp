<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\LeaveReason;
use Modules\HRIS\Models\Setup\LeaveClassification;
use Modules\HRIS\Http\Requests\Setup\LeaveReasonRequest;

class LeaveReasonController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.leave-reason.view')->only('index');
        $this->middleware('permission:hris.leave-reason.add')->only('store');
        $this->middleware('permission:hris.leave-reason.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.leave-reason.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leavereasons = LeaveReason::orderBy('id', 'desc')->get();
        $types = LeaveClassification::active()->pluck('code', 'code');
        return view('hris::setup.leavereason.index', compact('types', 'leavereasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveReasonRequest $request) {
        try {
            $data = $request->validated();
            $data['classification_id'] = $request->classification_id;
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            LeaveReason::create($data);
            return redirect()->route('hris.setup.leavereason.index')->with('success', 'Leave Reason created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create leave reason: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveReasonRequest $request, $id) {
        try {
            $leaveReason = LeaveReason::findOrFail($id);
            $leaveReason->update($request->validated());
            return redirect()->route('hris.setup.leavereason.index')->with('success', 'Leave Reason updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update leave reason: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            LeaveReason::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Leave Reason deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Leave Reason deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, LeaveReason::class);
    }
}
