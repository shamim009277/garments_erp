<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Http\Requests\Setup\CompanyShiftRequest;
use App\Traits\ToggleStatus;

class CompanyWiseShiftController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:hris.company-shift.view')->only('index');
        $this->middleware('permission:hris.company-shift.add')->only('store');
        $this->middleware('permission:hris.company-shift.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.company-shift.delete')->only('destroy');
    }

    public function index()
    {
        $shifts = CompanyWiseShift::with(['company:id,short_name',])->active()->get();
        $shiftList = Shift::pluck('shift', 'shift')->toArray();
        $orgList = Organization::pluck('short_name', 'id')->toArray();
        return view('hris::setup.companyshift.index', compact('shifts', 'shiftList', 'orgList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyShiftRequest $request) {
        try {
            CompanyWiseShift::create($request->validated());
            return redirect()->route('hris.setup.companywise-shifts.index')->with('success', 'Shift created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create shift: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyShiftRequest $request, $id) {
        try {
            $shift = CompanyWiseShift::find($id);
            $shift->update($request->validated());
            return redirect()->route('hris.setup.companywise-shifts.index')->with('success', 'Shift updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update shift: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $shift = CompanyWiseShift::find($request->id);
            $shift->delete();
            return redirect()->route('hris.setup.companywise-shifts.index')->with('success', 'Shift deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete shift: ' . $e->getMessage());
        }
    }

    public function shiftDetails(Request $request) {
        $shift = Shift::where('shift', $request->shift)->first();
        return response()->json([
            'success' => true,
            'data' => $shift
        ]);
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, CompanyWiseShift::class);
    }
}
