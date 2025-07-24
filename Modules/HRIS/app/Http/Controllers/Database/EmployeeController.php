<?php

namespace Modules\HRIS\Http\Controllers\Database;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Setup\Thana;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Organization;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $designations = Designation::active()->pluck('designation', 'id');
        $departments = Department::active()->pluck('department', 'id');

        $districts = District::active()->pluck('name', 'id');
        $shifts = Shift::active()->pluck('shift', 'shift');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $applicants = Applicant::with(['department:id,department', 'designation:id,designation'])->active()->fileEntry()->where('entry_date', '>=', $lst_30_days)->where('final_status', 1)->get();
        $unique_department = $applicants->unique('department_id');
        return view('hris::database.employee.index', compact('designations', 'departments', 'districts', 'applicants', 'unique_department', 'shifts', 'organizations'));
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
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tab = $request->tab;
        return view('hris::database.employee.show', compact('tab'));
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

    public function getThana($district_id) {
        $thanas = Thana::active()->where('district_id', $district_id)->pluck('name', 'id');
        return response()->json($thanas);
    }

    public function getGrade($designation_id) {
        $grades = Designation::select('id','grade')->find($designation_id);
        return response()->json($grades);
    }
}
