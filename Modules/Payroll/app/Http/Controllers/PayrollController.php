<?php

namespace Modules\Payroll\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\ProcessSalary;

class PayrollController extends Controller
{
    private function resolveAccessibleOrgId($requestedOrgId = null)
    {
        $userAccessId = Auth::user()->access_id;

        if ($userAccessId == 0) {
            return $requestedOrgId;
        }

        return $userAccessId;
    }

    private function getDashboardData($orgId = null)
    {
        $orgId = $this->resolveAccessibleOrgId($orgId);

        $orgQuery = Organization::active();
        if ($orgId) {
            $orgQuery->where('id', $orgId);
        }
        $organizations = $orgQuery->get();
        $orgIds = $organizations->pluck('id')->toArray();

        $currentMonth = Carbon::now();
        $curYear  = $currentMonth->year;
        $curMonth = $currentMonth->month;
        $prevMonthObj = $currentMonth->copy()->subMonth();
        $prevYear  = $prevMonthObj->year;
        $prevMonth = $prevMonthObj->month;

        $selectRaw = '
            org_id,
            COUNT(*) as processed_count,
            COUNT(DISTINCT employee_id) as employee_count,
            COALESCE(SUM(net_payable), 0) as net_payable,
            COALESCE(SUM(gross_payable), 0) as gross_payable,
            COALESCE(SUM(basic_payable), 0) as basic_payable,
            COALESCE(SUM(oa_payable), 0) as oa_payable,
            COALESCE(SUM(total_deduction), 0) as total_deduction,
            COALESCE(SUM(income_tax), 0) as income_tax,
            COALESCE(SUM(advance_amount), 0) as advance_amount,
            COALESCE(SUM(other_deduction), 0) as other_deduction,
            COALESCE(SUM(absent_deduction), 0) as absent_deduction,
            COALESCE(SUM(total_ot_amount), 0) as total_ot_amount,
            COALESCE(SUM(total_ot_hour), 0) as total_ot_hour,
            COALESCE(SUM(attendance_bonus), 0) as attendance_bonus,
            COALESCE(SUM(home_allowance), 0) as home_allowance,
            COALESCE(SUM(medical_allowance), 0) as medical_allowance,
            COALESCE(SUM(food_allowance), 0) as food_allowance,
            COALESCE(SUM(conveyance), 0) as conveyance,
            COALESCE(SUM(days), 0) as total_pay_days
        ';

        $curAgg = ProcessSalary::selectRaw($selectRaw)
            ->whereIn('org_id', $orgIds)
            ->where('year', $curYear)
            ->where('month', $curMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $prevAgg = ProcessSalary::selectRaw($selectRaw)
            ->whereIn('org_id', $orgIds)
            ->where('year', $prevYear)
            ->where('month', $prevMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $cur = (object)[
            'processed_count'   => 0,
            'employee_count'    => 0,
            'net_payable'       => 0,
            'gross_payable'     => 0,
            'basic_payable'     => 0,
            'oa_payable'        => 0,
            'total_deduction'   => 0,
            'income_tax'        => 0,
            'advance_amount'    => 0,
            'other_deduction'   => 0,
            'absent_deduction'  => 0,
            'total_ot_amount'   => 0,
            'total_ot_hour'     => 0,
            'attendance_bonus'  => 0,
            'home_allowance'    => 0,
            'medical_allowance' => 0,
            'food_allowance'    => 0,
            'conveyance'        => 0,
            'total_pay_days'    => 0,
        ];

        $prev = clone $cur;

        foreach ($organizations as $org) {
            $c = $curAgg->get($org->id);
            $p = $prevAgg->get($org->id);
            foreach (array_keys((array)$cur) as $k) {
                $cur->$k  += $c ? (float)$c->$k : 0;
                $prev->$k += $p ? (float)$p->$k : 0;
            }
        }

        $pct = function ($now, $old) {
            if ($old == 0 && $old == $now) return 0;
            if ($old == 0) return $now > 0 ? 100 : 0;
            return round((($now - $old) / abs($old)) * 100, 1);
        };

        $companyWisePayroll = [];
        foreach ($organizations as $org) {
            $c = $curAgg->get($org->id);
            $p = $prevAgg->get($org->id);
            $companyWisePayroll[] = [
                'name'              => $org->name,
                'short_name'        => $org->short_name ?: $org->name,
                'employee_count'    => (int)($c ? $c->employee_count : 0),
                'employee_count_prev' => (int)($p ? $p->employee_count : 0),
                'net_payable'       => (float)($c ? $c->net_payable : 0),
                'net_payable_prev'  => (float)($p ? $p->net_payable : 0),
                'gross_payable'     => (float)($c ? $c->gross_payable : 0),
                'total_ot_amount'   => (float)($c ? $c->total_ot_amount : 0),
            ];
        }
        $companyWisePayroll = array_values(array_filter($companyWisePayroll, function ($row) {
            return $row['employee_count'] > 0
                || $row['employee_count_prev'] > 0
                || $row['net_payable'] > 0
                || $row['net_payable_prev'] > 0;
        }));
        usort($companyWisePayroll, fn($a, $b) => $b['net_payable'] <=> $a['net_payable']);

        $totalChartEmployees   = array_sum(array_column($companyWisePayroll, 'employee_count'));
        $totalChartNetPayable  = array_sum(array_column($companyWisePayroll, 'net_payable'));
        $totalChartCompanies   = count($companyWisePayroll);

        return [
            'currentMonthName' => $currentMonth->format('F Y'),
            'prevMonthName'    => $prevMonthObj->format('F Y'),
            'totalCompanies'   => count($organizations),

            'companyWisePayroll'    => collect($companyWisePayroll)->values(),
            'totalChartEmployees'   => $totalChartEmployees,
            'totalChartNetPayable'  => $totalChartNetPayable,
            'totalChartCompanies'   => $totalChartCompanies,

            'netPayable'       => $cur->net_payable,
            'netPayablePrev'   => $prev->net_payable,
            'netPayableDiff'   => $pct($cur->net_payable, $prev->net_payable),

            'grossPayable'     => $cur->gross_payable,
            'grossPayablePrev' => $prev->gross_payable,
            'grossPayableDiff' => $pct($cur->gross_payable, $prev->gross_payable),
            'basicPayable'     => $cur->basic_payable,
            'oaPayable'        => $cur->oa_payable,

            'processedCount'   => (int)$cur->processed_count,
            'processedCountPrev' => (int)$prev->processed_count,
            'processedCountDiff' => $pct($cur->processed_count, $prev->processed_count),
            'employeeCount'    => (int)$cur->employee_count,

            'totalOtAmount'    => $cur->total_ot_amount,
            'totalOtAmountPrev'=> $prev->total_ot_amount,
            'totalOtAmountDiff'=> $pct($cur->total_ot_amount, $prev->total_ot_amount),
            'totalOtHour'      => $cur->total_ot_hour,
            'totalOtHourPrev'  => $prev->total_ot_hour,
            'totalOtHourDiff'  => $pct($cur->total_ot_hour, $prev->total_ot_hour),
            'advanceAmount'    => $cur->advance_amount,
            'advanceAmountPrev'=> $prev->advance_amount,
            'advanceAmountDiff'=> $pct($cur->advance_amount, $prev->advance_amount),

            'totalDeduction'   => $cur->total_deduction,
            'totalDeductionPrev' => $prev->total_deduction,
            'totalDeductionDiff' => $pct($cur->total_deduction, $prev->total_deduction),
            'incomeTax'        => $cur->income_tax,
            'absentDeduction'  => $cur->absent_deduction,

            'attendanceBonus'  => $cur->attendance_bonus,
            'attendanceBonusPrev' => $prev->attendance_bonus,
            'attendanceBonusDiff' => $pct($cur->attendance_bonus, $prev->attendance_bonus),

            'basicPayableCard'  => $cur->basic_payable,
            'basicPayableCardPrev' => $prev->basic_payable,
            'basicPayableCardDiff' => $pct($cur->basic_payable, $prev->basic_payable),
            'avgPayDay'        => $cur->processed_count > 0 ? round($cur->total_pay_days / $cur->processed_count, 1) : 0,
            'conveyance'       => $cur->conveyance,
        ];
    }

    public function index(Request $request)
    {
        $userAccessId = Auth::user()->access_id;
        $organizations = ($userAccessId == 0)
            ? Organization::active()->pluck('short_name', 'id')
            : Organization::active()->where('id', $userAccessId)->pluck('short_name', 'id');

        $requestedOrgId = $request->input('org_id');
        if (empty($requestedOrgId)) {
            $requestedOrgId = $userAccessId == 0 ? null : $userAccessId;
        }
        $orgId = $this->resolveAccessibleOrgId($requestedOrgId);

        $dashboardData = $this->getDashboardData($orgId);

        return view('payroll::index', array_merge($dashboardData, compact('organizations', 'orgId')));
    }

    public function getDashboardAjax(Request $request)
    {
        $orgId = $this->resolveAccessibleOrgId($request->org_id);
        $dashboardData = $this->getDashboardData($orgId);
        return response()->json($dashboardData);
    }

    public function create()
    {
        return view('payroll::create');
    }

    public function store(Request $request) {}

    public function show($id)
    {
        return view('payroll::show');
    }

    public function edit($id)
    {
        return view('payroll::edit');
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
