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
    public function destroy($id) {
        try {
            DepartureReason::findOrFail($id)->delete();
            return redirect()->route('hris.setup.departurereasons.index')->with('success', 'Departure reason deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete departure reason: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, DepartureReason::class);
    }
}
