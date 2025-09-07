<?php

namespace Modules\HRIS\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;

class ForwardApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::active()->pluck('department', 'id');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $employeeCategories = EmployeeCategory::active()->pluck('category', 'category_code');
        $users = User::active()->get();
        $activeUsers = $users->pluck('active_user', 'id');
        return view('hris::settings.forward-approve.index', compact('departments', 'organizations', 'employeeCategories', 'activeUsers'));
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
        $request->validate([
            'org_id' => 'required',
            'type' => 'required',
            'employee_id' => 'required|array',
            'user_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            if($request->type == 2) {
                $data = [];
                foreach($request->employee_id as $employee_id) {
                    $data[] = [
                        'org_id' => $request->org_id,
                        'user_id' => $request->user_id,
                        'employee_id' => $employee_id,
                        'is_active' => true,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ];
                }
                $result = DB::table('hris_settings_employee_gatepass_approve')->insert($data);
            }else if($request->type == 1){
                $data = [];
                foreach($request->employee_id as $employee_id) {
                    $data[] = [
                        'org_id' => $request->org_id,
                        'category_id' => $request->category_id,
                        'user_id' => $request->user_id,
                        'employee_id' => $employee_id,
                        'is_active' => true,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ];
                }
                $result = DB::table('hris_settings_employee_leave_forwardapprove')->insert($data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Data saved successfully');
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

    public function fetchUser(Request $request) {
        if($request->type == 2){
            $employeeIds = DB::table('hris_settings_employee_gatepass_approve')
                ->where('org_id', $request->org_id)
                ->where('user_id', $request->user_id)
                ->pluck('employee_id')
                ->toArray();
        }else if($request->type == 1){
            $employeeIds = DB::table('hris_settings_employee_leave_forwardapprove')
                ->where('org_id', $request->org_id)
                ->where('category_id', $request->category_id)
                ->where('user_id', $request->user_id)
                ->pluck('employee_id')
                ->toArray();
        }

        $employees = Employee::with([
            'department' => function ($q) use ($request) {
                $q->select('id', 'department')
                  ->when($request->department_id, fn($q) => $q->where('id', $request->department_id));
            },
            'designation' => function ($q) use ($request) {
                $q->select('id', 'designation', 'category_code')
                  ->when($request->employee_category_id, fn($q) => $q->where('category_code', $request->employee_category_id));
            },
            'organization' => function ($q) {
                $q->select('id', 'short_name');
            },
        ])
        ->select('id', 'employee_id', 'name', 'org_id', 'department_id', 'designation_id')
        ->whereNotIn('employee_id', $employeeIds)
        ->where('org_id', $request->org_id)
        ->where('reason', 'N')
        ->where('employee_id','!=',Auth::user()->employee_id)
        ->when($request->department_id, fn($q) => $q->where('department_id', $request->department_id))
        ->when($request->employee_category_id, fn($q) => $q->where('category_code', $request->employee_category_id))
        ->get();

        return response()->json($employees);
    }

    public function fetchApprovedData(Request $request) {
        if($request->type == 2){
            $approvedUsers = DB::table('hris_settings_employee_gatepass_approve as approve')
                ->leftJoin('hris_database_employee_basic as basic', 'approve.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->select('approve.id', 'basic.employee_id', 'basic.name', 'basic.org_id', 'department.department', 'designation.designation','designation.category_code')
                ->where('approve.org_id', $request->org_id)
                ->where('approve.user_id', $request->approved_user_id)
                ->get();
        }else if($request->type == 1){
            $approvedUsers = DB::table('hris_settings_employee_leave_forwardapprove as approve')
                ->leftJoin('hris_database_employee_basic as basic', 'approve.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->select('approve.id', 'basic.employee_id', 'basic.name', 'basic.org_id', 'department.department', 'designation.designation','designation.category_code')
                ->where('approve.org_id', $request->org_id)
                ->where('approve.category_id', 2)
                ->where('approve.user_id', $request->approved_user_id)
                ->get();
        }

        return response()->json($approvedUsers);
    }

    public function fetchForwardData(Request $request) {
        $forwardUsers = DB::table('hris_settings_employee_leave_forwardapprove as approve')
                ->leftJoin('hris_database_employee_basic as basic', 'approve.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->select('approve.id', 'basic.employee_id', 'basic.name', 'basic.org_id', 'department.department', 'designation.designation','designation.category_code')
                ->where('approve.org_id', $request->org_id)
                ->where('approve.category_id', 1)
                ->where('approve.user_id', $request->forward_user_id)
                ->get();

        return response()->json($forwardUsers);
    }

    public function deleteApprovedUser(Request $request) {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);

        try {
            if($request->form == 1){
                if($request->type == 2){
                    $result = DB::table('hris_settings_employee_gatepass_approve')
                        ->where('id', $request->id)
                        ->delete();
                }else if($request->type == 1){
                    $result = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->where('id', $request->id)
                        ->delete();
                }

                return response()->json($result);
            }else if($request->form == 2){
                if($request->type == 2){
                    $result = DB::table('hris_settings_employee_gatepass_approve')
                        ->whereIn('id', $request->id)
                        ->delete();
                }else if($request->type == 1){
                    $result = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->whereIn('id', $request->id)
                        ->delete();
                }
                return response()->json($result);
            }else if($request->form == 3){
                $result = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->where('category_id', 1)
                        ->where('id', $request->id)
                        ->delete();
                return response()->json($result);
            }else if($request->form == 4){
                $result = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->whereIn('id', $request->id)
                        ->where('category_id', 1)
                        ->delete();
                return response()->json($result);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function replaceUser(Request $request) {
        $request->validate([
            'existing_user' => 'required',
            'replace_user' => 'required',
            'type' => 'required',
            'replace_category_id' => 'required',
        ]);

        try {
            if($request->type == 2){
                $exists = DB::table('hris_settings_employee_gatepass_approve')
                    ->where('user_id', $request->existing_user)
                    ->exists();

                if (! $exists) {
                    return response()->json(['error' => 'The selected existing user has no data.']);
                }

                DB::table('hris_settings_employee_gatepass_approve')
                    ->where('user_id', $request->existing_user)
                    ->update(['user_id' => $request->replace_user]);

                return response()->json(['success' => true, 'message' => 'User replaced successfully']);
            }else if($request->type == 1){
                if($request->replace_category_id == 1){
                    $exists = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->where('user_id', $request->existing_user)
                        ->where('category_id', 1)
                        ->exists();
                }else if($request->replace_category_id == 2){
                    $exists = DB::table('hris_settings_employee_leave_forwardapprove')
                        ->where('user_id', $request->existing_user)
                        ->where('category_id', 2)
                        ->exists();
                }

                if (! $exists) {
                    return response()->json(['error' => 'The selected existing user has no data.']);
                }

                DB::table('hris_settings_employee_leave_forwardapprove')
                    ->where('user_id', $request->existing_user)
                    ->update(['user_id' => $request->replace_user]);

                return response()->json(['success' => true, 'message' => 'User replaced successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data replacement failed: ' . $e->getMessage()]);
        }
    }
}
