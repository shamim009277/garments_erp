<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\HRIS\Http\Requests\Setup\CompanyShiftRequest;
use Modules\HRIS\Http\Requests\Setup\CompanyWiseRamadanShiftRequest;
use Modules\HRIS\Models\Setup\CompanyWiseRamadanShift;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\Shift;

class CompanyWiseRamadanShiftController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */

    // function __construct()
    // {
    //     $this->middleware('permission:hris.companywise-ramadan-shift.view')->only('index');
    //     $this->middleware('permission:hris.companywise-ramadan-shift.add')->only('store');
    //     $this->middleware('permission:hris.companywise-ramadan-shift.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:hris.companywise-ramadan-shift.delete')->only('destroy');
    // }

    public function index()
    {
        $shifts = CompanyWiseRamadanShift::with(['company:id,short_name',])->active()->get();
        $shiftList = Shift::pluck('shift', 'shift')->toArray();
        $orgList = Organization::pluck('short_name', 'id')->toArray();
        return view('hris::setup.companywiseramadanshift.index', compact('shifts', 'shiftList', 'orgList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyWiseRamadanShiftRequest $request) {
        $exists = CompanyWiseRamadanShift::where('org_id', $request->org_id)
            ->where('shift', $request->shift)
            ->first();
        if ($exists) {
            return redirect()->back()->with('error', 'Shift already exists for this organization');
        }
        try {
            CompanyWiseRamadanShift::create($request->validated());
            return redirect()->route('hris.setup.companywise-ramadan-shifts.index')->with('success', 'Shift created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create shift: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyWiseRamadanShiftRequest $request, $id) {
        $exists = CompanyWiseRamadanShift::where('org_id', $request->org_id)
            ->where('shift', $request->shift)
            ->where('id', '<>', $id)
            ->first();
        if ($exists) {
            return redirect()->back()->with('error', 'Shift already exists for this organization');
        }
        try {
            $shift = CompanyWiseRamadanShift::find($id);
            $shift->update($request->validated());
            return redirect()->route('hris.setup.companywise-ramadan-shifts.index')->with('success', 'Shift updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update shift: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $shift = CompanyWiseRamadanShift::find($request->id);
            $shift->delete();
            return redirect()->route('hris.setup.companywise-ramadan-shifts.index')->with('success', 'Shift deleted successfully');
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
        return $this->ToggleStatusTrait($request, CompanyWiseRamadanShift::class);
    }
}
