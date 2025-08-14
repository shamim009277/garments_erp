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
        $districts = District::pluck('name', 'id')->toArray();
        $bloodGroups = ['O+' => 'O+', 'O-' => 'O-', 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'N/A' => 'N/A'];
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        return view('hris::report.employeelisting.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'districts', 'employeeCategories','bloodGroups'));
    }

    public function previewData(){
        return redirect()->route('hris.report.employee-listings.index');
    }

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
                return view('hris::report.employeelisting.preview', compact('employees','title','uniqueDepartments'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees','title','uniqueDepartments'))
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
                    ->orderBy('employee_id', 'asc')
                    ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.employeelisting.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
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
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.employeelisting.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 4){
            $request->validate([
                'department_id' => 'required|array',
                'blood_group' => 'required|array',
            ]);
            if($request->all_blood_group == true && $request->blood_group == null){
                $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'employeePersonal:employee_id,blood_group'])
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
            }elseif($request->all_blood_group == true && $request->blood_group != null){
                $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'employeePersonal:employee_id,blood_group'])
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
            
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.employeelisting.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.employeelisting.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }
    }
}
