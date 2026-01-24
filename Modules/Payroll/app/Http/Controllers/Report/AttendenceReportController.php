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

class AttendenceReportController extends Controller
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

        return view('payroll::report.attendence.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    public function previewData()
    {
        return redirect()->route('payroll.report.attendence-report.index');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'view_mode' => 'required|string|min:1|max:1',
        ]);

        if ($request->title == '1') {
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
                    'attendence.attn_type',
                    'attendence.start_punch',
                    'attendence.end_punch',
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

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.attendence.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.attendence.pdf', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))
                    ->setPaper('a4', 'landscape');

                return $pdf->stream('attendence.pdf');
            }
        } else if ($request->title == 2) {
            $request->validate([
                'employee_id' => 'required|integer|min:1',
                'month' => 'required',
                'year' => 'required',
            ]);

            $month = $request->month;
            $year = $request->year;
            $employee_id = $request->employee_id;

            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.attn_type',
                    'attendence.start_punch',
                    'attendence.end_punch',
                    DB::raw('COALESCE(designation.designation, "Not Assigned") as designation'),
                    'department.department',
                    'designation.category_code',
                    'organization.short_name',
                    'basic.name',
                    'basic.line'
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->where('attendence.employee_id', $employee_id)
                ->whereMonth('attendence.work_date', $month)
                ->whereYear('attendence.work_date', $year)
                ->orderBy('attendence.work_date', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->get();

            $title = $request->title;
            $monthName = Carbon::createFromFormat('m', $month)->format('F');
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.attendence.preview', compact('datas', 'title', 'monthName', 'year'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.attendence.pdf', compact('datas', 'title', 'monthName', 'year', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('attendence.pdf');
            }
        } else if ($request->title == 3) {
            $request->validate([
                'department_id' => 'required|array',
                'date' => 'required|date',
            ]);

            $department_id = $request->department_id;

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.attn_type',
                    'attendence.ot_hours',
                    'department.department',
                    'department.id as department_id',
                    'organization.short_name',
                    'basic.name'
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->where('attendence.work_date', $date)
                ->whereIn('basic.department_id', $request->department_id)
                ->orderBy('basic.department_id', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');

            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.attendence.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.attendence.pdf', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('attendence.pdf');
            }
        }else if($request->title == 4){
            $request->validate([
                'department_id' => 'required|array',
                'date' => 'required|date',
            ]);

            $department_id = $request->department_id;

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.attn_type',
                    'attendence.ot_hours',
                    'department.department',
                    'department.id as department_id',
                    'department.parent_department_id',
                    'parent_department.department as parent_department',
                    'organization.short_name',
                    'basic.name'
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parent_department', 'department.parent_department_id', '=', 'parent_department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->where('attendence.work_date', $date)
                ->whereIn('basic.department_id', $request->department_id)
                ->orderBy('basic.department_id', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('parent_department_id')->pluck('parent_department', 'parent_department_id');

            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.attendence.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.attendence.pdf', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('attendence.pdf');
            }
        }else if($request->title == 5){
            $request->validate([
                'date' => 'required|date',
                'organization_id' => 'required|integer',
            ]);

            $organization_id = $request->organization_id;
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.shift',
                    'attendence.attn_type',
                    'attendence.ot_hours',
                    'organization.short_name',
                    'organization.name',
                )
                ->leftJoin('hris_setup_organizations as organization', 'attendence.org_id', '=', 'organization.id')
                ->where('attendence.work_date', $date)
                ->where('attendence.org_id', $request->organization_id)
                ->orderBy('attendence.employee_id', 'asc')
                ->get();

            $uniqueOrganization = $datas->unique('org_id')->pluck('short_name', 'org_id');

            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.attendence.preview', compact('datas', 'title', 'date', 'uniqueOrganization'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.attendence.pdf', compact('datas', 'title', 'date', 'uniqueOrganization', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('attendence.pdf');
            }
        }
    }
}
