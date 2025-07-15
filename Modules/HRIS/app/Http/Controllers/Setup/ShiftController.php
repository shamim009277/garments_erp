<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Http\Requests\Setup\ShiftRequest;
use App\Traits\ToggleStatus;

class ShiftController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('hris::setup.shift.index', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request) {
        try {
            Shift::create($request->validated());
            return redirect()->route('hris.setup.shifts.index')->with('success', 'Shift created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create shift: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftRequest $request, $id) {
        try {
            Shift::findOrFail($id)->update($request->validated());
            return redirect()->route('hris.setup.shifts.index')->with('success', 'Shift updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update shift: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Shift::findOrFail($id)->delete();
            return redirect()->route('hris.setup.shifts.index')->with('success', 'Shift deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete shift: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Shift::class);
    }
}
