<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Http\Requests\Database\EmployeeIDAssignRequest;

class EmployeeIDAssignController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.employee-id-assign.view')->only('index');
        $this->middleware('permission:hris.employee-id-assign.add')->only('store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $designations = Designation::active()->pluck('designation', 'id');
        $applicants = Applicant::with(['department:id,department', 'designation:id,designation','organization:id,short_name'])->active()->where('entry_date', '>=', $lst_30_days)->where('final_status', 1)->get();
        $pending_applicants = $applicants->where('file_entry', 'N');
        $selected_applicants = $applicants->where('file_entry', 'Y');
        $organizations = Organization::active()->pluck('short_name', 'id');

        $grouped_data = collect($pending_applicants)
            ->groupBy('org_id')
            ->map(function ($org_items) {
                return $org_items->groupBy('department_id')
                    ->map(function ($dept_items) {
                        return $dept_items->groupBy('entry_date');
                    });
            });

        $grouped_selected_data = collect($selected_applicants)
            ->groupBy('org_id')
            ->map(function ($org_items) {
                return $org_items->groupBy('department_id')
                    ->map(function ($dept_items) {
                        return $dept_items->groupBy('entry_date');
                    });
            });

        $unique_applicant = [];


        return view('hris::database.employeeidassign.index', compact('pending_applicants', 'unique_applicant','designations','selected_applicants', 'grouped_data', 'grouped_selected_data', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeIDAssignRequest $request)
    {
        DB::beginTransaction();
        try {
            $applicant = Applicant::findOrFail($request->applicant_id);
            $applicant->employee_id = preg_replace('/\s+/', '', $request->employee_id);
            $applicant->final_designation_id = $request->final_designation_id;
            $applicant->recruitment_type = $request->recruitment_type;
            $applicant->file_entry = 'Y';
            $applicant->save();
            DB::commit();
            return redirect()->route('hris.database.employee-idassign.index')->with('success', 'Employee ID assigned successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('hris.database.employee-idassign.index')->with('error', 'Failed to assign Employee ID: ' . $e->getMessage());
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
