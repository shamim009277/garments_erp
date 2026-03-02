<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\PunchData;

class EditPunchDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        return view('payroll::tools.edit-punch.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payroll::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if($request->form == 1){
            $request->validate([
                'employee_id' => 'required',
                'organization_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $startDate = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');

            $attendence = PunchData::where('employee_id', $request->employee_id)
                ->where('org_id', $request->organization_id)
                ->whereBetween('work_date', [$startDate, $endDate])
                ->get();

             return response()->json([
                'success' => true,
                'data'    => $attendence,
            ]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('payroll::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('payroll::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'start_punch' => 'nullable|string|max:255',
            'end_punch' => 'nullable|string|max:50',
        ]);

        try {
            foreach (['start_punch', 'end_punch'] as $field) {
                if (isset($validated[$field]) && $validated[$field] === '0000-00-00 00:00') {
                    $validated[$field] = null;
                }
            }
            $punchdata = PunchData::findOrFail($id);
            $punchdata->fill($validated);
            $punchdata->save();

            return response()->json([
                'success' => true,
                'message' => 'Attendence updated successfully',
                'data' => $punchdata
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update attendence: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
