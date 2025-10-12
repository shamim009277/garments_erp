<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Models\Database\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicantReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.applicant-report.view')->only('index','previewData','preview');
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
        $gatepass_purposes = EmpGatepassPurpose::pluck('purpose', 'id')->toArray();

        return view('hris::report.applicant.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }

    public function previewData(){
        return redirect()->route('hris.report.applicant.index');
    }
    public function preview(Request $request){
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:1',
        ]);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $organizations = $request->organizations;
        $parentDepartments = $request->parentDepartments;
        $designations = $request->designations;
        $gatepass_purposes = $request->gatepass_purposes;

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])
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
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 2){
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('employee_id', 'asc')
                    ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 3){
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])

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
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 4){
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])

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
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }

        return view('hris::report.applicant.preview', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }


}
