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
use Modules\HRIS\Models\Database\LeaveConfirmation;
use App\Traits\LeaveBalance;

class LeaveApproveController extends Controller
{
    use LeaveBalance;

   /*  function __construct()
    {
        $this->middleware('permission:hris.leave-approve.view')->only('index');
        $this->middleware('permission:hris.leave-approve.add')->only('store');
        $this->middleware('permission:hris.leave-approve.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.leave-approve.delete')->only('destroy');
    } */
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
            $leaveApplications = LeaveApplication::active()->forwarded()->notRejected()->notApproved()->with('employee:id,employee_id,name,joining_date', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->orderBy('department_id', 'desc')->whereBetween('application_date', [$start_date, $end_date])->get();
        }else {
            $forwardids = DB::table('hris_settings_employee_leave_forwardapprove')->where('category_id', '2')->where('user_id', Auth::user()->id)->pluck('employee_id')->toArray();
            $leaveApplications = LeaveApplication::active()->forwarded()->notRejected()->notApproved()->with('employee:id,employee_id,name,joining_date', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->orderBy('department_id', 'desc')->whereBetween('application_date', [$start_date, $end_date])->whereIn('employee_id', $forwardids)->get();
        }

        return view('hris::database.leaveapprove.index', compact('leaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
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
                    ->forwarded()
                    ->notRejected()
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
                    ->forwarded()
                    ->notRejected()
                    ->whereIn('form_id', $formIds)
                    ->get()
                    ->keyBy('form_id');

                foreach ($formIds as $key => $form_id) {
                    if (isset($pendingApplications[$form_id])) {$nextId = (LeaveConfirmation::max('id') ?? 0) + 1;
                        $year = date('Y');
                        $leaveId = 'LV' . $year . str_pad($nextId + $key, 6, '0', STR_PAD_LEFT);

                        $data[] = [
                            'form_id'      => $form_id,
                            'start_date'   => $request->start_date[$key],
                            'end_date'     => $request->end_date[$key],
                            'days'         => $request->days[$key],
                            'is_approved'  => 'Y',
                            'approved_by'  => Auth::id(),
                            'approved_date'=> now()->format('Y-m-d'),
                        ];

                        $confirmations[] = [
                            'leave_id'       => $leaveId,
                            'employee_id'    => $pendingApplications[$form_id]->employee_id,
                            'department_id'  => $pendingApplications[$form_id]->department_id,
                            'designation_id' => $pendingApplications[$form_id]->designation_id,
                            'leave_type_id'  => $pendingApplications[$form_id]->leave_type_id,
                            'reason_id'      => $pendingApplications[$form_id]->reason_id,
                            'application_date'=> $pendingApplications[$form_id]->application_date,
                            'start_date'     => $request->start_date[$key],
                            'end_date'       => $request->end_date[$key],
                            'days'           => $request->days[$key],
                            'remarks'        => $pendingApplications[$form_id]->remarks,
                            'form_id'        => $form_id,
                            'created_by'     => Auth::id(),
                            'updated_by'     => Auth::id(),
                        ];
                    }
                }

                foreach ($data as $row) {
                    LeaveApplication::where('form_id', $row['form_id'])->update($row);
                }

                LeaveConfirmation::insert($confirmations);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Approved successfully',
                ]);
            }else if ($request->form == 3) {
                $request->validate([
                    'id' => 'required',
                    'form' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'days' => 'required',
                ]);
                $pendingApplication = LeaveApplication::active()
                    ->forwarded()
                    ->notRejected()
                    ->where('id', $request->id)
                    ->first();

                if ($pendingApplication) {
                    $pendingApplication->start_date   = $request->start_date;
                    $pendingApplication->end_date     = $request->end_date;
                    $pendingApplication->days         = $request->days;
                    $pendingApplication->is_approved   = 'Y';
                    $pendingApplication->approved_by   = Auth::id();
                    $pendingApplication->approved_date = now()->format('Y-m-d');
                    $pendingApplication->save();
                }
                //confirm leave

                LeaveConfirmation::create([
                    'employee_id' => $pendingApplication->employee_id,
                    'department_id' => $pendingApplication->department_id,
                    'designation_id' => $pendingApplication->designation_id,
                    'leave_type_id' => $pendingApplication->leave_type_id,
                    'reason_id' => $pendingApplication->reason_id,
                    'application_date' => $pendingApplication->application_date,
                    'start_date' => $pendingApplication->start_date,
                    'end_date' => $pendingApplication->end_date,
                    'days' => $pendingApplication->days,
                    'remarks' => $pendingApplication->remarks,
                    'form_id' => $pendingApplication->form_id,
                ]);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Approved successfully',
                ]);
            }else if ($request->form == 4) {
                $request->validate([
                    'id' => 'required',
                    'form' => 'required',
                ]);

                // Fetch all pending applications in one query
                $pending = LeaveApplication::active()
                    ->forwarded()
                    ->notRejected()
                    ->where('id', $request->id)
                    ->first();

                $pending->is_rejected   = 'Y';
                $pending->rejected_by   = Auth::id();
                $pending->rejected_date = now()->format('Y-m-d');
                $pending->save();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Leave Application Rejected successfully',
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
        $leaveApplication = LeaveApplication::active()->forwarded()->notRejected()->with('employee:id,employee_id,name,joining_date,photo', 'department:id,department', 'designation:id,designation', 'leaveReason:id,reason')->where('id', $id)->first();
        $reasons = LeaveReason::where('id',$leaveApplication->reason_id)->pluck('reason','id');
        $leave_types = LeaveClassification::pluck('signification','code');

        $leaveBalance = $this->calculateAccrualUpToToday($leaveApplication->employee_id);
        return view('hris::database.leaveapprove.show', compact('leaveApplication','reasons','leave_types','leaveBalance'));
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
