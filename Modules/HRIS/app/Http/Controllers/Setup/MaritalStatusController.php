<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\MaritalStatus;
use Modules\HRIS\Http\Requests\Setup\MaritalStatusRequest;
use App\Traits\ToggleStatus;

class MaritalStatusController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maritalStatuses = MaritalStatus::all();
        return view('hris::setup.maritalstatus.index', compact('maritalStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaritalStatusRequest $request) {
        try {
            MaritalStatus::create($request->validated());
            return redirect()->route('hris.setup.maritalstatus.index')->with('success', 'Marital Status created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create marital status: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaritalStatusRequest $request, $id) {
        try {
            $maritalStatus = MaritalStatus::findOrFail($id);
            $maritalStatus->update($request->validated());
            return redirect()->route('hris.setup.maritalstatus.index')->with('success', 'Marital Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update marital status: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            MaritalStatus::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Marital Status deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Marital Status deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, MaritalStatus::class);
    }
}
