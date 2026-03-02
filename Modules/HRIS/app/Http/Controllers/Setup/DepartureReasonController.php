<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\DepartureReason;
use Modules\HRIS\Http\Requests\Setup\DepartureReasonRequest;
use App\Traits\ToggleStatus;

class DepartureReasonController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.departure-reasons.view')->only('index');
        $this->middleware('permission:hris.departure-reasons.add')->only('store');
        $this->middleware('permission:hris.departure-reasons.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.departure-reasons.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departurereasons = DepartureReason::all();
        return view('hris::setup.departurereasons.index', compact('departurereasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartureReasonRequest $request) {
        try {
            DepartureReason::create($request->validated());
            return redirect()->route('hris.setup.departurereasons.index')->with('success', 'Departure reason created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create departure reason: ' . $th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DepartureReasonRequest $request, $id) {
        try {
            DepartureReason::findOrFail($id)->update($request->validated());
            return redirect()->route('hris.setup.departurereasons.index')->with('success', 'Departure reason updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update departure reason: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            DepartureReason::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Departure reason deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Departure reason deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, DepartureReason::class);
    }
}
