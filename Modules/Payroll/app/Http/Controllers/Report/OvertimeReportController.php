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
        $months = ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',];

        return view('payroll::report.overtime.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData()
    {
        return redirect()->route('payroll.report.overtime-report.index');
    }

    public function preview(Request $request){
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:1',
            'department_id' => 'required|array',
            'designation_id' => 'required|array',
        ]);

        if ($request->title == 1) {
            $month = $request->month;
            $year = $request->year;
            $start_date = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

            $datas = ProcessAttendence::select('employee_id','work_date', 'ot_hours','org_id')
                ->with([
                    'employee:id,name,employee_id,department_id,designation_id,org_id',
                    'employee.department:id,department,parent_department_id',
                    'employee.department.parentDepartment:id,department',
                    'employee.designation:id,designation,category_code',
                    'organization:id,short_name',
                ])
                ->where('org_id', $request->organization_id)
                ->whereBetween('work_date', [$start_date, $end_date])
                ->where('ot_hours', '>', 0)

                // Employee Filter
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereHas('employee', function ($subQuery) use ($request) {
                        $subQuery
                            ->when(!empty($request->department_id), function ($q) use ($request) {
                                $q->whereIn('department_id', $request->department_id);
                            })
                            ->when(!empty($request->designation_id), function ($q) use ($request) {
                                $q->whereIn('designation_id', $request->designation_id);
                            });
                    });
                })
                ->when($request->filled('category_id'), function ($q) use ($request) {
                    $q->whereHas('employee.designation', function ($q2) use ($request) {
                        $q2->where('category_code', $request->category_id);
                    });
                })
                ->get();

            //dd($datas);

            $uniqueSection = $datas
                ->pluck('employee.department')
                ->filter()
                ->groupBy(function ($dept) {
                    return optional($dept->parentDepartment)->id;
                })
                ->map(function ($items, $parentId) {
                    $parent = optional($items->first()->parentDepartment);
                    return [
                        'parent_department_id'   => $parentId,
                        'parent_department_name' => $parent->department ?? 'N/A',
                        'departments' => $items
                            ->unique('id')
                            ->map(function ($dept) {
                                return [
                                    'id'   => $dept->id,
                                    'name' => $dept->department,
                                ];
                            })
                            ->values()
                    ];
                })
                ->values();

            $grouped = $datas->groupBy('employee_id');

            //dd($grouped);

            $dates = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $date) {
                $dates[] = $date->format('Y-m-d');
            }
            $organization = Organization::active()->where('id', $request->organization_id)->first()->name;
            $title = $request->title;
            $monthName = Carbon::parse($start_date)->format('F');
            $orgid = $request->organization_id;
        if ($request->view_mode == 1) {
            return view('payroll::report.overtime.preview', compact('datas','uniqueSection','title','grouped','start_date','end_date','dates','organization','monthName','year','orgid'));
        } elseif ($request->view_mode == 2) {
            ini_set('memory_limit', '4048M');
            ini_set('max_execution_time', '700');
            $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas','uniqueSection','title','grouped','start_date','end_date','dates','organization','monthName','year','orgid'))->setPaper('a4', 'landscape');
            return $pdf->stream('overtime.pdf');
        }
    } else if ($request->title == 2) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $datas = ProcessAttendence::select('id', 'org_id', 'employee_id', 'work_date', 'ot_hours','start_punch','end_punch')
                ->with([
                    'employee:id,name,employee_id,department_id,designation_id,org_id',
                    'employee.department:id,department,parent_department_id',
                    'employee.department.parentDepartment:id,department',
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

            $uniqueSection = $datas
                ->pluck('employee.department')
                ->filter()
                ->groupBy(function ($dept) {
                    return optional($dept->parentDepartment)->id;
                })
                ->map(function ($items, $parentId) {
                    $parent = optional($items->first()->parentDepartment);
                    return [
                        'parent_department_id'   => $parentId,
                        'parent_department_name' => $parent->department ?? 'N/A',
                        'departments' => $items
                            ->unique('id')
                            ->map(function ($dept) {
                                return [
                                    'id'   => $dept->id,
                                    'name' => $dept->department,
                                ];
                            })
                            ->values()
                    ];
                })
                ->values();
            $uniqueDepartments = $datas->pluck('employee.department')->unique('id')->pluck('department', 'id');
            $title = $request->title;
            $date = $request->date;
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.overtime.preview', compact('datas', 'title', 'uniqueDepartments', 'uniqueSection', 'date','orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas', 'title', 'uniqueDepartments', 'uniqueSection', 'date','orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('overtime.pdf');
            }
        } else if ($request->title == 3) {
            $month = $request->month;
            $year = $request->year;
            $start_date = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

            $datas = DB::table('payroll_tools_process_attendence as attendence')
                ->select(
                    'attendence.employee_id',
                    'organization.short_name',
                    'basic.name',
                    'department.department',
                    'parentDepartment.department as parent_department',
                    'designation.designation',
                    'designation.category_code',
                    'attendence.shift',
                    DB::raw('SUM(attendence.ot_hours) as total_ot')
                )
                ->leftJoin('hris_database_employee_basic as basic', 'attendence.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parentDepartment', 'department.parent_department_id', '=', 'parentDepartment.id')
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
                ->groupBy(
                    'attendence.employee_id',
                    'organization.short_name',
                    'basic.name',
                    'department.department',
                    'parentDepartment.department',
                    'designation.designation',
                    'designation.category_code',
                    'attendence.shift'
                )
                ->orderBy('parentDepartment.department', 'asc')
                ->orderBy('department.department', 'asc')
                ->orderBy('attendence.employee_id', 'asc')
                ->get();

            $sectionGrouped = $datas->groupBy('parent_department');

            //dd($sectionGrouped);
            $organization = Organization::active()->where('id', $request->organization_id)->first()->name;
            $title = $request->title;
            $monthName = Carbon::parse($start_date)->format('F');
            $orgid = $request->organization_id;

            if ($request->view_mode == 1) {
                return view('payroll::report.overtime.preview2', compact('datas', 'title', 'sectionGrouped', 'year','monthName','orgid','organization'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.overtime.pdf', compact('datas', 'title', 'sectionGrouped', 'year','monthName','orgid','organization'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('overtime.pdf');
            }
        }
    }
}
