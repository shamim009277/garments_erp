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

class BonusReportController extends Controller
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

        return view('payroll::report.bonus.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'employeeCategories', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData()
    {
        return redirect()->route('payroll.report.bonus-report.index');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'view_mode' => 'required|string|min:1|max:1',
        ]);

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $title = $request->title;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $orgid = $request->organization_id;

        if($request->title == 1){
            $datas = DB::table('payroll_tools_process_bonus as bonus')
                ->select(
                    'bonus.*',
                    'designation.designation',
                    'department.department',
                    'department.id as department_id',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                    'basic.line',
                    'parent_department.department as section',
                    'bonus.gross_salary', // Bonus table has gross_salary
                )
                ->leftJoin('hris_database_employee_basic as basic', 'bonus.employee_id', '=', 'basic.employee_id')
                // ->leftJoin('hris_database_employee_salary as empsalary', 'bonus.employee_id', '=', 'empsalary.employee_id') // Not strictly needed if bonus table has data
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parent_department', 'department.parent_department_id', '=', 'parent_department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('bonus.org_id', $request->organization_id)
                // ->where('bonus.month', $request->month) // ProcessBonus doesn't have month column usually, it has base_date or year/bonus_type
                ->where('bonus.year', $request->year)
                ->when($request->filled('month'), function ($query) use ($request) {
                     $query->whereMonth('bonus.base_date', $request->month);
                })
                ->when($request->filled('employee_id'), function ($query) use ($request) {
                    $query->where('bonus.employee_id', $request->employee_id);
                }, function ($query) use ($request) {
                    $query->whereIn('bonus.department_id', $request->department_id)
                        ->whereIn('bonus.designation_id', $request->designation_id)
                        ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->where('designation.category_code', $request->category_id);
                        });
                })
                ->when($request->filled('line'), function ($query) use ($request) {
                    $query->where('bonus.line', $request->line);
                })
                ->orderBy('bonus.department_id', 'asc')
                ->orderBy('bonus.designation_id', 'asc')
                ->orderBy('bonus.employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department', 'department_id');
            $title = $request->title;
            $month = Carbon::createFromFormat('m', $request->month);
            $monthName = $month->format('F');
            $year = $request->year;

            if ($request->view_mode == 1) {
                return view('payroll::report.bonus.preview', compact('datas', 'title', 'uniqueDepartments', 'monthName', 'year', 'date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.bonus.pdf', compact('datas', 'title', 'uniqueDepartments', 'monthName', 'year', 'date', 'orgid'))
                    ->setPaper('Legal', 'landscape');

                return $pdf->stream('bonus.pdf');
            }
        }else if($request->title == 2){
            $datas = DB::table('payroll_tools_process_bonus as bonus')
                ->select(
                    'bonus.*',
                    'designation.designation',
                    'department.department',
                    'department.id as department_id',
                    'basic.joining_date',
                    'organization.short_name',
                    'basic.name',
                    'basic.line',
                    'parent_department.department as section',
                    'bonus.gross_salary',
                )
                ->leftJoin('hris_database_employee_basic as basic', 'bonus.employee_id', '=', 'basic.employee_id')
                ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                ->leftJoin('hris_setup_parent_departments as parent_department', 'department.parent_department_id', '=', 'parent_department.id')
                ->leftJoin('hris_setup_organizations as organization', 'basic.org_id', '=', 'organization.id')
                ->where('bonus.org_id', $request->organization_id)
                ->where('bonus.year', $request->year)
                ->when($request->filled('month'), function ($query) use ($request) {
                    $query->whereMonth('bonus.base_date', $request->month);
                })
                ->where('bonus.employee_id', $request->employee_id) // ✅ MUST
                ->when($request->filled('line'), function ($query) use ($request) {
                    $query->where('bonus.line', $request->line);
                })
                ->orderBy('bonus.department_id')
                ->orderBy('bonus.designation_id')
                ->orderBy('bonus.employee_id')
                ->first();

            $title = $request->title;
            $month = Carbon::createFromFormat('m', $request->month);
            $monthName = $month->format('F');
            $year = $request->year;

            if ($request->view_mode == 1) {
                return view('payroll::report.bonus.preview', compact('datas', 'title', 'monthName', 'year', 'date', 'orgid'));
            } elseif ($request->view_mode == 2) {
                $pdf = Pdf::loadView('payroll::report.bonus.pdf', compact('datas', 'title', 'monthName', 'year', 'date', 'orgid'))
                    ->setPaper('Legal', 'landscape');

                return $pdf->stream('bonus.pdf');
            }
        }
    }
}
