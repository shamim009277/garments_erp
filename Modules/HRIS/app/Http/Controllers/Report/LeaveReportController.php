<?php

namespace Modules\HRIS\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\LeaveApplication;

class LeaveReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.leave-report.view')->only('index','previewData','preview');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id');
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
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1',
        ]);

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');

            $leaves = LeaveApplication::with(['employee:id,org_id,name', 'leaveReason:id,reason', 'department:id,department', 'designation:id,designation,category_code'])
                    ->whereIn('department_id', $request->department_id)
                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->whereHas('employee', function ($q) use ($request) {
                        $q->where('org_id', $request->organization_id);
                    })
                    ->whereBetween('application_date', [$start, $end])
                    ->orderBy('employee_id', 'asc')
                    ->get();

            $uniqueDepartments = $leaves->unique('department_id')->pluck('department','department_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.leave.preview', compact('leaves','title','uniqueDepartments'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.leave.pdf', compact('leaves','title','uniqueDepartments'))->setPaper('a4', 'portrait');

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
                return view('hris::report.leave.preview', compact('employees','title','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.leave.pdf', compact('employees','title','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 3){
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|array',
                'end_date' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                    ->whereIn('department_id', $request->department_id)
                    ->whereBetween('joining_date', [$request->start_date, $request->end_date])
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
                    ->orderBy('employee_id', 'asc')
                    ->get();

            $uniqueEmployees = $employees->unique('employee_id')->pluck('employee_id','employee_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.leave.preview', compact('employees','title','uniqueEmployees'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.leave.pdf', compact('employees','title','uniqueEmployees'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 4){
            $request->validate([
                'month' => 'required'
            ]);
            $month = $request->month;

            $startDate = Carbon::createFromDate(now()->year, $month, 1)->startOfMonth()->toDateString();
            $endDate   = Carbon::createFromDate(now()->year, $month, 1)->endOfMonth()->toDateString();
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                    //->whereMonth('joining_date', $request->month)
                    ->whereBetween('joining_date', [$startDate, $endDate])
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
                    /* ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('mdistrict.id', 'asc') */
                    ->get();
            $uniqueDistricts = $employees->unique('mdistrict.id')->pluck('mdistrict.id','mdistrict.id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.leave.preview', compact('employees','title','uniqueDistricts'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.leave.pdf', compact('employees','title','uniqueDistricts'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 5){
            $request->validate([
                'organization_id' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                    ->whereIn('org_id', $request->organization_id)
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
                    ->orderBy('org_id', 'asc')
                    ->get();

            $uniqueOrganizations = $employees->unique('org_id')->pluck('org_id','org_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.leave.preview', compact('employees','title','uniqueOrganizations'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.leave.pdf', compact('employees','title','uniqueOrganizations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }

    }


}
