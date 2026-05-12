<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Database\EmployeePersonal;

class EmployeeListingReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.employee-listings.view')->only('index', 'previewData', 'preview');
    }
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
        $districts = District::pluck('name', 'id')->toArray();
        $bloodGroups = ['O+' => 'O+', 'O-' => 'O-', 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'N/A' => 'N/A'];
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        return view('hris::report.employeelisting.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'districts', 'employeeCategories', 'bloodGroups'));
    }

    public function previewData()
    {
        return redirect()->route('hris.report.employee-listings.index');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:9',
        ]);
        $orgid = $request->organization_id;
        if ($request->title == 1) {
            $request->validate([
                'department_id' => 'required|array',
            ]);
            $line = $request->all_line;
            if ($line == true) {
                $line = false;
            } elseif ($line == false) {
                $line = $request->line;
            }
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                ->whereHas('designation')
                ->whereIn('department_id', $request->department_id)
                ->when($line == true, fn($q) =>
                $q->where('line', $line))
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

            $uniqueDepartments = $employees->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;

            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueDepartments', 'orgid'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueDepartments', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        } elseif ($request->title == 2) {
            $request->validate([
                'designation_id' => 'required|array',
            ]);
            $line = $request->all_line;
            if ($line == true) {
                $line = false;
            } elseif ($line == false) {
                $line = $request->line;
            }
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                ->whereIn('designation_id', $request->designation_id)
                ->when($line == true, fn($q) =>
                $q->where('line', $line))
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
            $uniqueDepartments = $employees->unique('department_id')->pluck('department', 'department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation', 'designation_id');
            $title = $request->title;
            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        } elseif ($request->title == 3) {
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name'])
                ->whereHas('designation')
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
            $uniqueDepartments = $employees->unique('department_id')->pluck('department', 'department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation', 'designation_id');
            $title = $request->title;
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));
            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid', 'start_date', 'end_date'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid', 'start_date', 'end_date'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        } elseif ($request->title == 4) {
            $request->validate([
                'department_id' => 'required|array'
                //'blood_group' => 'required|array',
            ]);
            if ($request->all_blood_group == true || $request->blood_group == null) {
                $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'employeePersonal:employee_id,blood_group'])
                    ->whereHas('designation')
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
                    ->orderBy('employee_id', 'asc')
                    ->get();
            } elseif ($request->all_blood_group == true || $request->blood_group != null) {
                $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'employeePersonal:employee_id,blood_group'])
                    ->whereHas('designation')
                    ->whereIn('department_id', $request->department_id)
                    ->whereHas('employeePersonal', function ($q) use ($request) {
                        $q->whereIn('blood_group', $request->blood_group);
                    })
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
            }

            $uniqueDepartments = $employees->unique('department_id')->pluck('department', 'department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation', 'designation_id');
            $title = $request->title;
            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueDepartments', 'uniqueDesignations', 'orgid'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        } else if ($request->title == 5) {
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');

            $employees = Employee::active()
                ->with([
                    'department:id,department,parent_department_id',
                    'department.parentDepartment:id,department',
                    'designation:id,designation,category_code',
                    'organization:id,short_name',
                    'employeeSalary:id,employee_id,gross_salary'
                ])
                ->when($start && $end, function ($q) use ($start, $end) {
                    $q->whereBetween('joining_date', [$start, $end]);
                })
                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->when($request->filled('line'),fn($q) =>
                    $q->where('line', $request->line)
                )
                ->when($request->filled('employee_id'),fn($q) =>
                    $q->where('employee_id', $request->employee_id)
                )
                ->when($request->filled('category_id'), function ($q) use ($request) {
                    $q->whereHas('designation', function ($q2) use ($request) {
                        $q2->where('category_code', $request->category_id);
                    });
                })
                ->when($request->filled('organization_id'),fn($q) =>
                    $q->where('org_id', $request->organization_id)
                )
                ->when($request->filled('designation_id'),fn($q) =>
                    $q->whereIn('designation_id', $request->designation_id)
                )
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueSection = $employees
                ->pluck('department')
                ->filter()
                ->groupBy('parent_department_id')
                ->map(function ($items, $parentId) {
                    $parent = optional($items->first()->parentDepartment);

                    return [
                        'parent_department_id' => $parentId,
                        'parent_department_name' => $parent->department,
                        'departments' => $items->unique('id')->map(function ($dept) {
                            return [
                                'id' => $dept->id,
                                'name' => $dept->department,
                            ];
                        })->values()
                    ];
                })
                ->values();

            $organization = Organization::active()->where('id', $request->organization_id)->first()->name;
            $start_date = $start;
            $end_date = $end;    
            $title = $request->title;


            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueSection', 'orgid','start','end','organization'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueSection', 'orgid','start_date','end_date','organization'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        }else if ($request->title == 6) {
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');

            $employees = Employee::resigned()
                ->where('org_id', $request->organization_id)
                ->with([
                    'department:id,department,parent_department_id',
                    'department.parentDepartment:id,department',
                    'designation:id,designation,category_code',
                    'organization:id,short_name',
                    'employeeSalary:id,employee_id,gross_salary'
                ])
                ->when($start && $end, function ($q) use ($start, $end) {
                    $q->whereBetween('leaving_date', [$start, $end]);
                })
                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->when($request->filled('line'),fn($q) =>
                    $q->where('line', $request->line)
                )
                ->when($request->filled('employee_id'),fn($q) =>
                    $q->where('employee_id', $request->employee_id)
                )
                ->when($request->filled('category_id'), function ($q) use ($request) {
                    $q->whereHas('designation', function ($q2) use ($request) {
                        $q2->where('category_code', $request->category_id);
                    });
                })
                ->when($request->filled('designation_id'),fn($q) =>
                    $q->whereIn('designation_id', $request->designation_id)
                )
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueSection = $employees
                ->pluck('department')
                ->filter()
                ->groupBy('parent_department_id')
                ->map(function ($items, $parentId) {
                    $parent = optional($items->first()->parentDepartment);

                    return [
                        'parent_department_id' => $parentId,
                        'parent_department_name' => $parent->department,
                        'departments' => $items->unique('id')->map(function ($dept) {
                            return [
                                'id' => $dept->id,
                                'name' => $dept->department,
                            ];
                        })->values()
                    ];
                })
                ->values();

            $organization = Organization::active()->where('id', $request->organization_id)->first()->name;
            $start_date = $start;
            $end_date = $end;    
            $title = $request->title;

            //dd($employees,$uniqueSection);

            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueSection', 'orgid','start','end','organization'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueSection', 'orgid','start_date','end_date','organization'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        }else if ($request->title == 7) {
            $request->validate([
                'department_id' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');

            $employees = Employee::longAbsence()
                ->with([
                    'department:id,department,parent_department_id',
                    'department.parentDepartment:id,department',
                    'designation:id,designation,category_code',
                    'organization:id,short_name',
                    'employeeSalary:id,employee_id,gross_salary'
                ])
                ->when($start && $end, function ($q) use ($start, $end) {
                    $q->whereBetween('leaving_date', [$start, $end]);
                })
                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->when($request->filled('line'),fn($q) =>
                    $q->where('line', $request->line)
                )
                ->when($request->filled('employee_id'),fn($q) =>
                    $q->where('employee_id', $request->employee_id)
                )
                ->when($request->filled('category_id'), function ($q) use ($request) {
                    $q->whereHas('designation', function ($q2) use ($request) {
                        $q2->where('category_code', $request->category_id);
                    });
                })
                ->when($request->filled('organization_id'),fn($q) =>
                    $q->where('org_id', $request->organization_id)
                )
                ->when($request->filled('designation_id'),fn($q) =>
                    $q->whereIn('designation_id', $request->designation_id)
                )
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueSection = $employees
                ->pluck('department')
                ->filter()
                ->groupBy('parent_department_id')
                ->map(function ($items, $parentId) {
                    $parent = optional($items->first()->parentDepartment);

                    return [
                        'parent_department_id' => $parentId,
                        'parent_department_name' => $parent->department,
                        'departments' => $items->unique('id')->map(function ($dept) {
                            return [
                                'id' => $dept->id,
                                'name' => $dept->department,
                            ];
                        })->values()
                    ];
                })
                ->values();

            $organization = Organization::active()->where('id', $request->organization_id)->first()->name;
            $start_date = $start;
            $end_date = $end;    
            $title = $request->title;

            if ($request->view_mode == 1) {
                return view('hris::report.employeelisting.preview', compact('employees', 'title', 'uniqueSection', 'orgid','start','end','organization'));
            } elseif ($request->view_mode == 2) {
                ini_set('memory_limit', '4048M');
                ini_set('max_execution_time', '600');
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees', 'title', 'uniqueSection', 'orgid','start_date','end_date','organization','start','end'))
                    ->setPaper('a4', 'portrait');

                return $pdf->stream('employee.pdf');
            }
        }
    }
}
