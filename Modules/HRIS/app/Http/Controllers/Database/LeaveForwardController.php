<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\LeaveApplication;

class LeaveForwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveApplications = LeaveApplication::active()->pending()->with('employee:id,employee_id,name,joining_date', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->orderBy('department_id', 'desc')->get();
        return view('hris::database.leaveforward.index', compact('leaveApplications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'form_id' => 'required|array',
            'form' => 'required',
            'start_date' => 'required|array',
            'end_date' => 'required|array',
            'days' => 'required|array',
        ]);

        try {
            if ($request->form == 1) {
                $formIds = $request->form_id;

                $pendingApplications = LeaveApplication::active()
                    ->pending()
                    ->whereIn('form_id', $formIds)
                    ->get()
                    ->keyBy('form_id');

                foreach ($formIds as $form_id) {
                    if (isset($pendingApplications[$form_id])) {
                        $pending = $pendingApplications[$form_id];
                        $pending->is_rejected   = 'Y';
                        $pending->rejected_by   = Auth::id();
                        $pending->rejected_date = now()->format('Y-m-d');
                        $pending->save();
                    }
                }

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Discarded successfully',
                ]);
            }

            if ($request->form == 2) {
                $formIds = $request->form_id;

                // Fetch all pending applications in one query
                $pendingApplications = LeaveApplication::active()
                    ->pending()
                    ->whereIn('form_id', $formIds)
                    ->get()
                    ->keyBy('form_id');

                foreach ($formIds as $key => $form_id) {
                    if (isset($pendingApplications[$form_id])) {
                        $pending = $pendingApplications[$form_id];
                        $pending->start_date   = $request->start_date[$key];
                        $pending->end_date     = $request->end_date[$key];
                        $pending->days         = $request->days[$key];
                        $pending->is_forward   = 'Y';
                        $pending->forward_by   = Auth::id();
                        $pending->forward_date = now()->format('Y-m-d');
                        $pending->save();
                    }
                }
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Forwarded successfully',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
