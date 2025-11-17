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

class SalaryReportController extends Controller
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

        return view('payroll::report.salary.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData()
    {
        return redirect()->route('payroll.report.salary-report.index');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'view_mode' => 'required|string|min:1|max:1',
        ]);

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $title = $request->title;

        if($request->title == 1){

            $datas = DB::table('payroll_tools_process_salary as salary')
                ->select(
                    'salary.*',
                    'designation.designation',
                    'department.department',
                    'department.id as department_id',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                    'basic.line',
                    'parent_department.department as parent_department',
                    'empsalary.gross_salary',
                    'empsalary.attendance_bonus',
                )
                ->leftJoin('hris_database_employee_basic as basic', 'salary.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_database_employee_salary as empsalary', 'salary.employee_id', '=', 'empsalary.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parent_department', 'department.parent_department_id', '=', 'parent_department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('salary.org_id', $request->organization_id)
                ->where('salary.month', $request->month)
                ->where('salary.year', $request->year)
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('salary.employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereIn('salary.department_id', $request->department_id)
                        ->whereIn('salary.designation_id', $request->designation_id)
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->where('designation.category_code', $request->category_id);
                        });
                })
                ->when($request->filled('line'), function ($query) use ($request) {
                    $query->where('salary.line', $request->line);
                })
                ->orderBy('salary.department_id', 'asc')
                ->orderBy('salary.designation_id', 'asc')
                ->orderBy('salary.employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $month = Carbon::createFromFormat('m', $request->month);
            $monthName = $month->format('F');
            $year = $request->year;

            if ($request->view_mode == 1) {
                return view('payroll::report.salary.preview', compact('datas', 'title', 'uniqueDepartments', 'monthName', 'year'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.salary.pdf', compact('datas', 'title', 'uniqueDepartments', 'monthName', 'year'))
                    ->setPaper('A4', 'landscape');

                return $pdf->stream('salary.pdf');
            }
        }
    }
}
