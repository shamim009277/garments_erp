<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\BloodGroup;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;

class EmployeeListingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $designations = Designation::orderBy('designation', 'asc')->get();
        $districts = District::pluck('name', 'id')->toArray();
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        return view('hris::report.employeelisting.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'districts', 'employeeCategories'));
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
