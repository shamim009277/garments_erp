<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Database\Applicant;
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

        $unique_applicant = [];
        $unique_department = $pending_applicants->unique('department_id');
        $unique_selected_department = $selected_applicants->unique('department_id');

        return view('hris::database.employeeidassign.index', compact('pending_applicants', 'unique_applicant', 'unique_department','designations','unique_selected_department','selected_applicants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeIDAssignRequest $request)
    {
        DB::beginTransaction();
        try {
            $applicant = Applicant::findOrFail($request->applicant_id);
            $applicant->employee_id = $request->employee_id;
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
