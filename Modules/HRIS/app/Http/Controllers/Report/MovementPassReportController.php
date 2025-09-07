<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;

class MovementPassReportController extends Controller
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
        $gatepass_purposes = EmpGatepassPurpose::pluck('purpose', 'id')->toArray();
        return view('hris::report.movementpass.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
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
