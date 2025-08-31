<?php

namespace Modules\HRIS\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\EmployeeCategory;

class LeaveReportController extends Controller
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
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        return view('hris::report.leave.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData(){
        return redirect()->route('hris.report.leave-report.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function preview(Request $request)
    {

    }


}
