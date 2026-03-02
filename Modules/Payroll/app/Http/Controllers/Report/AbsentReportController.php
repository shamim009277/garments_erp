<?php

namespace Modules\Payroll\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;

class AbsentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('d-m-Y');
        $endDate = Carbon::now()->endOfMonth()->format('d-m-Y');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments')->orderBy('department', 'asc')->get();
        $designations = Designation::orderBy('designation', 'asc')->get();
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        $lines = Employee::where('line', '!=', 0)->orderBy('line', 'asc')->pluck('line', 'line')->unique()->toArray();

        return view('payroll::report.absent.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'lines'));
    }

    public function previewData()
    {
        return redirect()->route('payroll.report.absent-report.index');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:1',
            'department_id' => 'required|array',
            'designation_id' => 'required|array',
        ]);

        $orgid = $request->organization_id;

        if ($request->title == 1) {
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
                ->where('attendence.attn_type', 'AB')
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
                ->orderBy('attendence.work_date', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');

            $title = $request->title;
            $date = $request->date;

            if ($request->view_mode == 1) {
                return view('payroll::report.absent.preview', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.absent.pdf', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))
                    ->setPaper('a4', 'landscape');

                return $pdf->stream('absent.pdf');
            }
        } else if ($request->title == 2) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
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
                ->where('attendence.attn_type', 'AB')
                ->where('attendence.org_id', $request->organization_id)
                ->whereBetween('attendence.work_date', [$start_date, $end_date])
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

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            if ($request->view_mode == 1) {
                return view('payroll::report.absent.preview', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.absent.pdf', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date', 'orgid'))
                    ->setPaper('a4', 'landscape');

                return $pdf->stream('absent.pdf');
            }
        } else if ($request->title == 3) {
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
                ->where('attendence.attn_type', 'AB')
                ->whereNotNull('attendence.start_punch')
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
                ->orderBy('attendence.work_date', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');

            $title = $request->title;
            $date = $request->date;

            if ($request->view_mode == 1) {
                return view('payroll::report.absent.preview', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.absent.pdf', compact('datas', 'title', 'uniqueDepartments', 'date', 'orgid'))
                    ->setPaper('a4', 'landscape');

                return $pdf->stream('absent.pdf');
            }
        } else if ($request->title == 4) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

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
                ->whereNotNull('attendence.start_punch')
                ->where('attendence.attn_type', 'AB')
                ->where('attendence.org_id', $request->organization_id)
                ->whereBetween('attendence.work_date', [$start_date, $end_date])
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

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            if ($request->view_mode == 1) {
                return view('payroll::report.absent.preview', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.absent.pdf', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date', 'orgid'))
                    ->setPaper('a4', 'landscape');

                return $pdf->stream('absent.pdf');
            }
        }
    }
}
