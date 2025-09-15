<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\LeaveReason;
use Modules\HRIS\Models\Database\LeaveApplication;
use Modules\HRIS\Models\Setup\LeaveClassification;
use App\Traits\LeaveBalance;

class LeaveForwardController extends Controller
{
    use LeaveBalance;

    function __construct()
    {
        $this->middleware('permission:hris.leave-forward.view')->only('index');
        $this->middleware('permission:hris.leave-forward.add')->only('store');
        $this->middleware('permission:hris.leave-forward.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.leave-forward.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time = Carbon::now()->format('Y-m-d');
        $time = Carbon::parse($time)->subDay(10)->format('Y-m-d');
        $start_date = Carbon::parse($time)->startOfMonth()->format('Y-m-d');
        $end_date = Carbon::parse($time)->endOfMonth()->format('Y-m-d');

        if(Auth::user()->role == 'Super Admin') {
            $leaveApplications = LeaveApplication::active()->pending()->with('employee:id,employee_id,name,joining_date', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->orderBy('department_id', 'desc')->whereBetween('application_date', [$start_date, $end_date])->get();
        }else {
            $forwardids = DB::table('hris_settings_employee_leave_forwardapprove')->where('category_id', '1')->where('user_id', Auth::user()->id)->pluck('employee_id')->toArray();
            $leaveApplications = LeaveApplication::active()->pending()->with('employee:id,employee_id,name,joining_date', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->orderBy('department_id', 'desc')->whereBetween('application_date', [$start_date, $end_date])->whereIn('employee_id', $forwardids)->get();
        }

        return view('hris::database.leaveforward.index', compact('leaveApplications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        try {
            if ($request->form == 1) {
                $request->validate([
                    'form_id' => 'required|array',
                    'form' => 'required',
                    'start_date' => 'required|array',
                    'end_date' => 'required|array',
                    'days' => 'required|array',
                ]);

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
            }else if ($request->form == 2) {
                $request->validate([
                    'form_id' => 'required|array',
                    'form' => 'required',
                    'start_date' => 'required|array',
                    'end_date' => 'required|array',
                    'days' => 'required|array',
                ]);
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
            }else if ($request->form == 3) {
                $request->validate([
                    'id' => 'required',
                    'form' => 'required',
                ]);

                // Fetch all pending applications in one query
                $pending = LeaveApplication::active()
                    ->pending()
                    ->where('id', $request->id)
                    ->first();

                $pending->is_rejected   = 'Y';
                $pending->rejected_by   = Auth::id();
                $pending->rejected_date = now()->format('Y-m-d');
                $pending->save();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Discarded successfully',
                ]);
            }else if ($request->form == 4) {
                $request->validate([
                    'id' => 'required',
                    'form' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'days' => 'required',
                ]);

                // Fetch all pending applications in one query
                $pending = LeaveApplication::active()
                    ->pending()
                    ->where('id', $request->id)
                    ->first();

                $pending->start_date   = $request->start_date;
                $pending->end_date     = $request->end_date;
                $pending->days         = $request->days;
                $pending->is_forward   = 'Y';
                $pending->forward_by   = Auth::id();
                $pending->forward_date = now()->format('Y-m-d');
                $pending->save();

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
        $leaveApplication = LeaveApplication::active()->pending()->with('employee:id,employee_id,name,joining_date,photo', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->where('id', $id)->first();
        $leave_types = LeaveClassification::pluck('signification','code');
        $reasons = LeaveReason::where('id',$leaveApplication->reason_id)->pluck('reason','id');

        $leaveBalance = $this->calculateAccrualUpToToday($leaveApplication->employee_id);
        return view('hris::database.leaveforward.show', compact('leaveApplication','leave_types','reasons','leaveBalance'));
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
