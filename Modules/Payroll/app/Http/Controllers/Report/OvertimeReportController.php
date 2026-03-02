<?php

namespace Modules\Payroll\Http\Controllers\Report;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\Payroll\Models\Tools\ProcessAttendence;

class OvertimeReportController extends Controller
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

        return view('payroll::report.overtime.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData()
    {
        return redirect()->route('payroll.report.overtime-report.index');
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

        if ($request->title == 1) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $datas = ProcessAttendence::select('employee_id', 'work_date', 'ot_hours', 'org_id')
                ->with([
                    'employee:id,name,employee_id,department_id,designation_id,org_id',
                    'employee.department:id,department',
                    'employee.designation:id,designation,category_code',
                    'organization:id,short_name',
                ])
                ->where('org_id', $request->organization_id)
                ->whereBetween('work_date', [$start_date, $end_date])
                ->where('ot_hours', '>', 0)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereHas('employee', function ($subQuery) use ($request) {
                        $subQuery->whereIn('department_id', $request->department_id)
                            ->whereIn('designation_id', $request->designation_id);
                    })
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('employee.designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                        });
                })
                ->get();

            $grouped = $datas->groupBy('employee_id');

            $title = $request->title;
            $start_date = $start_date;
            $end_date = $end_date;

            $dates = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $date) {
                $dates[] = $date->format('Y-m-d');
            }

            if ($request->view_mode == 1) {
                return view('payroll::report.overtime.preview', compact('datas', 'title', 'grouped', 'start_date', 'end_date', 'dates'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas', 'title', 'grouped', 'start_date', 'end_date', 'dates'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('overtime.pdf');
            }
        } else if ($request->title == 2) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = ProcessAttendence::select('id', 'org_id', 'employee_id', 'work_date', 'ot_hours')
                ->with([
                    'employee:id,name,employee_id,department_id,designation_id,org_id',
                    'employee.department:id,department',
                    'employee.designation:id,designation,category_code',
                    'organization:id,short_name',
                ])
                ->where('ot_hours', '>', 0)
                ->where('org_id', $request->organization_id)
                ->where('work_date', $date)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereHas('employee', function ($subQuery) use ($request) {
                        $subQuery->whereIn('department_id', $request->department_id)
                            ->whereIn('designation_id', $request->designation_id);
                    })
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('employee.designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                        });
                })
                ->get();

            $uniqueDepartments = $datas->pluck('employee.department')->unique('id')->pluck('department', 'id');
            $title = $request->title;
            $date = $request->date;

            if ($request->view_mode == 1) {
                return view('payroll::report.overtime.preview', compact('datas', 'title', 'uniqueDepartments', 'date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas', 'title', 'uniqueDepartments', 'date'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('overtime.pdf');
            }
        } else if ($request->title == 3) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'attendence.org_id',
                    'attendence.work_date',
                    'attendence.ot_hours',
                    'attendence.shift',
                    'designation.designation',
                    'department.department',
                    'designation.category_code',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('attendence.org_id', $request->organization_id)
                ->whereBetween('attendence.work_date', [$start_date, $end_date])
                ->where('attendence.ot_hours', '>', 0)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('attendence.employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereIn('basic.department_id', $request->department_id)
                        ->whereIn('basic.designation_id', $request->designation_id)
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->where('designation.category_code', $request->category_id);
                        });
                })
                ->orderBy('basic.department_id', 'asc')
                ->orderBy('basic.designation_id', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->orderBy('attendence.work_date', 'asc')
                ->get();

            $uniqueDepartments = $datas->pluck('department')->unique('id')->pluck('department', 'id');
            $title = $request->title;
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            if ($request->view_mode == 1) {
                return view('payroll::report.overtime.preview', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas', 'title', 'uniqueDepartments', 'start_date', 'end_date'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('overtime.pdf');
            }
        }
    }
}
