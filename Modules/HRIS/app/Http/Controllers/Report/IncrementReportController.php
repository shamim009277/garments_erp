<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmpIncrement;
use Modules\HRIS\Models\Database\EmpIncrementPurpose;
use Barryvdh\DomPDF\Facade\Pdf;

class IncrementReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.increment-report.view')->only('index','previewData','preview');
    }
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

        return view('hris::report.increment.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData(Request $request){
        return redirect()->route('hris.report.increment.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:1',
        ]);

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                    ->whereIn('department_id', $request->department_id)
                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('department_id', 'asc')
                    ->orderBy('employee_id', 'asc')
                    ->get();

            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.increment.preview', compact('employees','title','uniqueDepartments'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.increment.pdf', compact('employees','title','uniqueDepartments'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 2){
            $request->validate([
                'designation_id' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                    ->whereIn('designation_id', $request->designation_id)
                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('designation_id', 'asc')
                    ->orderBy('employee_id', 'asc')
                    ->get();

            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.increment.preview', compact('employees','title','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.increment.pdf', compact('employees','title','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }
    }
}
