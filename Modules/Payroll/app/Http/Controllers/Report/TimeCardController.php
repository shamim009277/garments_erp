<?php

namespace Modules\Payroll\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;

class TimeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments')->orderBy('department', 'asc')->get();
        $designations = Designation::orderBy('designation', 'asc')->get();
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        $months = ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',];

        return view('payroll::report.timecard.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData()
    {
        return redirect()->route('payroll.report.timecard.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'organization_id' => 'required|integer',
            'month' => 'required',
            'year' => 'required',
            'view_mode' => 'required',
            'category_id'  => 'required_without:all_category',
            'all_category' => 'required_without:category_id|in:on',
            'line'     => 'required_without:all_line',
            'all_line' => 'required_without:line|in:on',
            'department_id' => 'required|array|min:1',
            'department_id.*' => 'integer',
            'designation_id' => 'required|array|min:1',
            'designation_id.*' => 'integer',
            'employee_id' => 'nullable|integer',
        ]);

        if($request->title == 1){
            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.attn_type',
                    'attendence.start_punch',
                    'attendence.end_punch',
                    'attendence.rwh',
                    'attendence.wwh',
                    'attendence.ot_hours',
                    'attendence.is_late',
                    'attendence.late_minutes',
                    'designation.designation',
                    'department.department',
                    'parent_department.department as section',
                    'department.id as department_id',
                    'designation.category_code',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                    'basic.line',
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parent_department', 'department.parent_department_id', '=', 'parent_department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->whereMonth('attendence.work_date', $request->month)
                ->whereYear('attendence.work_date', $request->year)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('attendence.employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereIn('basic.department_id', $request->department_id)
                        ->whereIn('basic.designation_id', $request->designation_id)
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->where('designation.category_code', $request->category_id);
                        });
                })
                ->when($request->filled('line'), function ($query) use ($request) {
                    $query->where('basic.line', $request->line);
                })
                ->orderBy('basic.department_id', 'asc')
                ->orderBy('basic.designation_id', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->orderBy('attendence.work_date', 'asc')
                ->get();

            $uniqueEmployee = $datas->unique('employee_id')->pluck('employee_id');
            $title = $request->title;
            $year = $request->year;
            $monthName = Carbon::createFromFormat('m', $request->month)->format('F');

            if ($request->view_mode == 1) {
                return view('payroll::report.timecard.preview', compact('datas', 'title', 'monthName', 'year', 'uniqueEmployee'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.timecard.pdf', compact('datas', 'title', 'monthName', 'year', 'uniqueEmployee'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('timecard.pdf');
            }
        }
    }

    /**
     * Show the specified resource.
     */
}
