<?php

namespace Modules\HRIS\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\ProcessAttendence;

class HRISController extends Controller
{
    /**
     * Get dashboard data for a specific organization (or all if null)
     */
    private function getDashboardData($orgId = null)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd   = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd   = Carbon::now()->subMonth()->endOfMonth();
        $todayDate = now()->toDateString();

        // Build organization query
        $orgQuery = Organization::active();
        if ($orgId) {
            $orgQuery->where('id', $orgId);
        }
        $organizations = $orgQuery->get();
        $orgIds = $organizations->pluck('id')->toArray(); // Get org IDs to filter queries

        // 1. Get all employee data aggregated by org_id in one query
        $employeeAggData = Employee::active()->selectRaw('
                org_id,
                COUNT(*) as total_employees,
                COUNT(CASE WHEN joining_date BETWEEN ? AND ? THEN 1 END) as current_month_joining,
                COUNT(CASE WHEN joining_date BETWEEN ? AND ? THEN 1 END) as last_month_joining,
                COUNT(CASE WHEN leaving_date BETWEEN ? AND ? THEN 1 END) as current_month_resigned,
                COUNT(CASE WHEN leaving_date BETWEEN ? AND ? THEN 1 END) as last_month_resigned
            ', [
                $currentMonthStart,
                $currentMonthEnd,
                $lastMonthStart,
                $lastMonthEnd,
                $currentMonthStart,
                $currentMonthEnd,
                $lastMonthStart,
                $lastMonthEnd,
            ])
            ->whereIn('org_id', $orgIds)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        // 2. Get process attendance aggregated data in one query
        $attendanceAggData = ProcessAttendence::selectRaw('
                emp.org_id,
                COUNT(DISTINCT payroll_tools_process_attendence.employee_id) as total_punched,
                COUNT(DISTINCT CASE WHEN payroll_tools_process_attendence.attn_type = \'PR\' THEN payroll_tools_process_attendence.employee_id END) as present_count,
                COUNT(DISTINCT CASE WHEN payroll_tools_process_attendence.attn_type = \'AB\' THEN payroll_tools_process_attendence.employee_id END) as absent_count,
                COUNT(DISTINCT CASE WHEN payroll_tools_process_attendence.attn_type IN (\'CL\', \'EL\', \'SL\') THEN payroll_tools_process_attendence.employee_id END) as leave_count
            ')
            ->join('hris_database_employee_basic as emp', 'payroll_tools_process_attendence.employee_id', '=', 'emp.employee_id')
            ->whereDate('payroll_tools_process_attendence.work_date', $todayDate)
            ->where('emp.is_active', true)
            ->where('emp.reason', 'N')
            ->whereIn('emp.org_id', $orgIds)
            ->groupBy('emp.org_id')
            ->get()
            ->keyBy('org_id');

        // 3. Get applicant count in one query
        $applicantAggData = Applicant::selectRaw('
                org_id,
                COUNT(*) as total_applicants,
                COUNT(CASE WHEN entry_date BETWEEN ? AND ? THEN 1 END) as new_applicants_this_month,
                COUNT(CASE WHEN interview_status = ? AND entry_date BETWEEN ? AND ? THEN 1 END) as selected_count,
                COUNT(CASE WHEN interview_status NOT IN (?, ?) AND entry_date BETWEEN ? AND ? THEN 1 END) as rejected_count
            ', [
                $currentMonthStart,
                $currentMonthEnd,
                'Selected',
                $currentMonthStart,
                $currentMonthEnd,
                'Pending',
                'Selected',
                $currentMonthStart,
                $currentMonthEnd
            ])
            ->where('is_active', true)
            ->whereIn('org_id', $orgIds)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        // Now build the data arrays using pre-aggregated data
        $companyWiseEmployees = [];
        $companyWiseMovement = [];
        $companyAttendance = [];

        $totalEmployees = 0;
        $todayPresent = 0;
        $todayAbsent = 0;
        $onLeave = 0;
        $newJoiners = 0;
        $resignedThisMonth = 0;
        $newApplicantsThisMonth = 0;
        $selectedCount = 0;
        $rejectedCount = 0;
        $totalCompanies = count($organizations);

        foreach ($organizations as $org) {
            $empData = $employeeAggData->get($org->id);
            $attData = $attendanceAggData->get($org->id);
            $appData = $applicantAggData->get($org->id);

            $totalEmp = $empData ? $empData->total_employees : 0;
            if ($totalEmp <= 0) continue;

            $punchedEmp = $attData ? $attData->total_punched : 0;
            $presentCount = $attData ? $attData->present_count : 0;
            $absentCount = $attData ? $attData->absent_count : 0;
            $leaveCount = $attData ? $attData->leave_count : 0;
            $newAppThisMonthCount = $appData ? $appData->new_applicants_this_month : 0;
            $selectedOrgCount = $appData ? $appData->selected_count : 0;
            $rejectedOrgCount = $appData ? $appData->rejected_count : 0;

            // Company wise employees
            $companyWiseEmployees[] = [
                'name' => $org->name,
                'short_name' => $org->short_name ?: $org->name,
                'total' => $totalEmp,
            ];

            // Company wise movement
            $companyWiseMovement[] = [
                'name' => $org->name,
                'short_name' => $org->short_name ?: $org->name,
                'total' => $totalEmp,
                'last_month_joining' => $empData ? (int) $empData->last_month_joining : 0,
                'current_month_joining' => $empData ? (int) $empData->current_month_joining : 0,
                'last_month_resigned' => $empData ? (int) $empData->last_month_resigned : 0,
                'current_month_resigned' => $empData ? (int) $empData->current_month_resigned : 0,
            ];

            // Company attendance
            $companyAttendance[] = [
                'company' => $org->short_name ?: $org->name,
                'total_employee' => $totalEmp,
                'punched_employee' => $punchedEmp,
                'not_punched' => max($totalEmp - $punchedEmp, 0),
                'attendance_rate' => $totalEmp > 0 ? round(($punchedEmp / $totalEmp) * 100, 1) : 0,
            ];

            // Accumulate totals
            $totalEmployees += $totalEmp;
            $todayPresent += $presentCount;
            $todayAbsent += $absentCount;
            $onLeave += $leaveCount;
            $newJoiners += $empData ? $empData->current_month_joining : 0;
            $resignedThisMonth += $empData ? $empData->current_month_resigned : 0;
            $newApplicantsThisMonth += $newAppThisMonthCount;
            $selectedCount += $selectedOrgCount;
            $rejectedCount += $rejectedOrgCount;
        }

        // Sort the arrays
        usort($companyWiseEmployees, fn($a, $b) => $b['total'] <=> $a['total']);
        usort($companyWiseMovement, fn($a, $b) => $b['total'] <=> $a['total']);
        usort($companyAttendance, fn($a, $b) => $b['total_employee'] <=> $a['total_employee']);

        return [
            'companyWiseEmployees' => collect($companyWiseEmployees)->values(),
            'companyWiseMovement' => collect($companyWiseMovement)->values(),
            'companyAttendance' => collect($companyAttendance)->values(),
            'totalEmployees' => $totalEmployees,
            'todayPresent' => $todayPresent,
            'todayAbsent' => $todayAbsent,
            'onLeave' => $onLeave,
            'newJoiners' => $newJoiners,
            'resignedThisMonth' => $resignedThisMonth,
            'newApplicantsThisMonth' => $newApplicantsThisMonth,
            'selectedCount' => $selectedCount,
            'rejectedCount' => $rejectedCount,
            'totalCompanies' => $totalCompanies,
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $organizations = (Auth::user()->access_id == 0) ? Organization::active()->pluck('short_name', 'id') : Organization::active()->where('id', Auth::user()->access_id)->pluck('short_name', 'id');

        // Get default org_id: use request org_id, else user's access_id if not 0, else null (all orgs)
        $orgId = $request->input('org_id');
        if (empty($orgId)) {
            $orgId = Auth::user()->access_id == 0 ? null : Auth::user()->access_id;
        }

        $dashboardData = $this->getDashboardData($orgId);

        return view('hris::index', array_merge($dashboardData, compact('organizations', 'orgId')));
    }

    /**
     * Get dashboard data via AJAX
     */
    public function getDashboardAjax(Request $request)
    {
        $orgId = $request->org_id;
        $dashboardData = $this->getDashboardData($orgId);
        return response()->json($dashboardData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
