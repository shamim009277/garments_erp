<?php

namespace Modules\Payroll\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;

class PunchReportController extends Controller
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

        return view('payroll::report.punch.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    public function previewData()
    {
        return redirect()->route('payroll.report.punch.pdf');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'view_mode' => 'required',
            'organization_id' => 'required',
        ]);

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
                'designation_id' => 'required|array',
                'date' => 'required|date',
            ]);

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = DB::table('payroll_tools_punch_data as punchdata')
                ->select(
                    'punchdata.employee_id',
                    'punchdata.org_id',
                    'punchdata.work_date',
                    'punchdata.shift',
                    'punchdata.start_punch',
                    'punchdata.end_punch',
                    'designation.designation',
                    'department.department',
                    'department.id as department_id',
                    'designation.category_code',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                    'basic.line',
                )
                ->leftJoin('hris_database_employee_basic as basic', 'punchdata.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('punchdata.org_id', $request->organization_id)
                ->where('punchdata.work_date', $date)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('punchdata.employee_id', $request->employee_id);
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
                ->orderBy('punchdata.employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.punch.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.punch.pdf2', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))->setPaper('a4', 'portrait');

                return $pdf->stream('punch.pdf');
            }
        }else if($request->title == 2){
            $request->validate([
                'month' => 'required',
                'year' => 'required',
                'employee_id' => 'required',
            ]);

            $month = $request->month;
            $year = $request->year;
            $employee_id = $request->employee_id;

            $datas = DB::table('payroll_tools_punch_data as punchdata')
                ->select(
                    'punchdata.employee_id',
                    'punchdata.org_id',
                    'punchdata.work_date',
                    'punchdata.shift',
                    'punchdata.start_punch',
                    'punchdata.end_punch',
                    DB::raw('COALESCE(designation.designation, "Not Assigned") as designation'),
                    'department.department',
                    'designation.category_code',
                    'organization.short_name',
                    'basic.name',
                    'basic.line'
                )
                ->leftJoin('hris_database_employee_basic as basic', 'punchdata.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('punchdata.org_id', $request->organization_id)
                ->where('punchdata.employee_id', $employee_id)
                ->whereMonth('punchdata.work_date', $month)
                ->whereYear('punchdata.work_date', $year)
                ->orderBy('punchdata.work_date', 'asc')
                ->orderBy('punchdata.employee_id', 'asc')
                ->get();

            $employee = $datas->first();
            $title = $request->title;
            $monthName = Carbon::createFromFormat('m', $month)->format('F');
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.punch.preview', compact('datas', 'title', 'monthName', 'year', 'employee'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.punch.pdf2', compact('datas', 'title', 'monthName', 'year', 'employee', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('punch.pdf');
            }
        } else if($request->title == 3){
            $request->validate([
                'month' => 'required',
                'year' => 'required',
            ]);

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

            //dd($uniqueEmployee);

            if ($request->view_mode == 1) {
                return view('payroll::report.punch.preview', compact('datas', 'title', 'monthName', 'year', 'uniqueEmployee'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.punch.pdf', compact('datas', 'title', 'monthName', 'year', 'uniqueEmployee'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('punch.pdf');
            }
        }else if($request->title == 4 || $request->title == 5 || $request->title == 6){
            $request->validate([
                'department_id' => 'required|array',
                'designation_id' => 'required|array',
                'date' => 'required|date',
            ]);

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.start_punch',
                    'attendence.end_punch',
                    'attendence.is_late',
                    'attendence.is_early_leave',
                    'attendence.late_minutes',
                    'attendence.early_minutes',
                    'attendence.attn_type',
                    'designation.designation',
                    'department.department',
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
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->where('attendence.work_date', $date)

                // 🔥 TITLE BASED CONDITION
                ->when($request->title == 4, function ($q) {
                    $q->where('attendence.is_late', 'Y');
                })
                ->when($request->title == 5, function ($q) {
                    $q->where('attendence.is_early_leave', 'Y');
                })
                ->when($request->title == 6, function ($q) {
                    $q->where('attendence.attn_type', 'AB')
                    ->whereNotNull('attendence.start_punch')
                    ->whereNotNull('attendence.end_punch');
                })

                // EMPLOYEE / DEPARTMENT FILTER
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
                ->get();

            //dd($datas);


            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.punch.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.punch.pdf2', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))->setPaper('a4', 'portrait');

                return $pdf->stream('punch.pdf');
            }
        }
    }
}
