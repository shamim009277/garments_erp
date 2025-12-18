<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;

class ShiftingReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.shifting-report.view')->only('index','previewData','preview');
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
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
        $year = Carbon::now()->year;

        return view('hris::report.shift.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories','year','months'));
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
            'organization_id' => 'required|integer|min:1|max:1',
        ]);

        $orgid = $request->organization_id;

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
            $shifts = ShiftingList::with([
                    'employeeBasic:id,employee_id,name,org_id,department_id,designation_id',
                    'employeeBasic.organization:id,short_name',
                    'employeeBasic.department:id,department',
                    'employeeBasic.designation:id,designation,category_code',
                ])
                ->whereBetween('date', [$startDate, $endDate])
                ->whereHas('employeeBasic', function ($q) use ($request) {
                    $q->where('org_id', $request->organization_id);
                    if (!empty($request->department_id)) {
                        $q->whereIn('department_id', (array) $request->department_id);
                    }
                    if ($request->filled('employee_id')) {
                        $q->where('employee_id', $request->employee_id);
                    }
                    if ($request->filled('category_id')) {
                        $q->whereHas('designation', function ($q2) use ($request) {
                            $q2->where('category_code', $request->category_id);
                        });
                    }
                })
                ->orderBy('employee_id', 'asc')
                ->orderBy('date', 'asc')
                ->get();

            $uniqueDepartments = $shifts->unique('department_id')->pluck('department','department_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.shift.preview', compact('shifts','title','uniqueDepartments','startDate','endDate','orgid'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.shift.pdf', compact('shifts','title','uniqueDepartments','startDate','endDate','orgid'))->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }

        }elseif($request->title == 2){
            $request->validate([
                'designation_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
            $shifts = ShiftingList::with([
                    'employeeBasic:id,employee_id,name,org_id,department_id,designation_id',
                    'employeeBasic.organization:id,short_name',
                    'employeeBasic.department:id,department',
                    'employeeBasic.designation:id,designation',
                ])
                ->whereBetween('date', [$startDate, $endDate])
                ->whereHas('employeeBasic', function ($q) use ($request) {
                    $q->where('org_id', $request->organization_id);
                    if (!empty($request->designation_id)) {
                        $q->whereIn('designation_id', (array) $request->designation_id);
                    }
                    if ($request->filled('employee_id')) {
                        $q->where('employee_id', $request->employee_id);
                    }
                    if ($request->filled('category_id')) {
                        $q->whereHas('designation', function ($q2) use ($request) {
                            $q2->where('category_code', $request->category_id);
                        });
                    }
                })
                ->orderBy('employee_id', 'asc')
                ->orderBy('date', 'asc')
                ->get();

            $uniqueDesignations = $shifts->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.shift.preview', compact('employees','title','uniqueDesignations','startDate','endDate','orgid'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.shift.pdf', compact('employees','title','uniqueDesignations','startDate','endDate','orgid'))->setPaper('a4', 'portrait');
                return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 3){
            $request->validate([
                'department_id' => 'required|array',
                'year' => 'required|numeric',
                'month' => 'required|numeric',
            ]);
            $year = $request->year;
            $month = $request->month;

            $shifts = ShiftingList::with([
                    'employeeBasic:id,employee_id,name,org_id,department_id,designation_id',
                    'employeeBasic.organization:id,short_name',
                    'employeeBasic.department:id,department',
                    'employeeBasic.designation:id,designation',
                ])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->whereHas('employeeBasic', function ($q) use ($request) {
                    $q->where('org_id', $request->organization_id);
                    if (!empty($request->department_id)) {
                        $q->whereIn('department_id', (array) $request->department_id);
                    }
                    if ($request->filled('employee_id')) {
                        $q->where('employee_id', $request->employee_id);
                    }
                    if ($request->filled('category_id')) {
                        $q->whereHas('designation', function ($q2) use ($request) {
                            $q2->where('category_code', $request->category_id);
                        });
                    }
                })
                ->orderBy('employee_id', 'asc')
                ->orderBy('date', 'asc')
                ->get();

            $uniqueDepartments = $shifts->unique('department_id')->pluck('designation','department_id');
            $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.shift.preview', compact('shifts','title','uniqueDepartments','months','month','year'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.shift.pdf', compact('shifts','title','uniqueDepartments','months','month','year'))->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 4){
            $request->validate([
                'designation_id' => 'required|array',
                'month' => 'required|numeric',
                'year' => 'required|numeric',
            ]);
            $month = $request->month;
            $year = $request->year;
            $shifts = ShiftingList::with([
                    'employeeBasic:id,employee_id,name,org_id,department_id,designation_id',
                    'employeeBasic.organization:id,short_name',
                    'employeeBasic.department:id,department',
                    'employeeBasic.designation:id,designation',
                ])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->whereHas('employeeBasic', function ($q) use ($request) {
                    $q->where('org_id', $request->organization_id);
                    if (!empty($request->designation_id)) {
                        $q->whereIn('designation_id', (array) $request->designation_id);
                    }
                    if ($request->filled('employee_id')) {
                        $q->where('employee_id', $request->employee_id);
                    }
                    if ($request->filled('category_id')) {
                        $q->whereHas('designation', function ($q2) use ($request) {
                            $q2->where('category_code', $request->category_id);
                        });
                    }
                })
                ->orderBy('employee_id', 'asc')
                ->orderBy('date', 'asc')
                ->get();

            $uniqueDesignations = $shifts->unique('designation_id')->pluck('designation','designation_id');
            $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.shift.preview', compact('shifts','title','uniqueDesignations','months','month','year','orgid'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.shift.pdf', compact('shifts','title','uniqueDesignations','months','month','year','orgid'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }
    }
}
