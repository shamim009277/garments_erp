<?php

namespace Modules\IPE\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Database\Applicant;
use Modules\IPE\Models\Database\Assessment;

class IPEController extends Controller
{
    
    private function resolveAccessibleOrgId($requestedOrgId = null)
    {
        $userAccessId = Auth::user()->access_id;

        if ($userAccessId == 0) {
            return $requestedOrgId;
        }

        return $userAccessId;
    }

    private function getMonthlyAgg($orgIds, $year, $month)
    {
        $subQuery = DB::table('hris_database_new_applicant as a')
            ->leftJoin('ipe_database_new_assessment as ass', function ($join) {
                $join->on('ass.applicant_id', '=', 'a.id');
            })
            ->select(
                'a.id',
                'a.org_id',
                DB::raw("CASE WHEN a.interview_status = 'Selected' THEN 1 ELSE 0 END as is_selected"),
                DB::raw("CASE WHEN a.interview_status IN ('Disqualify','Not Recruit') THEN 1 ELSE 0 END as is_rejected"),
                DB::raw('MAX(CASE WHEN ass.is_done = 1 THEN 1 ELSE 0 END) as has_done_assessment')
            )
            ->where('a.ipe_assessment_required', true)
            ->whereYear('a.entry_date', $year)
            ->whereMonth('a.entry_date', $month)
            ->whereIn('a.org_id', $orgIds)
            ->groupBy([
                'a.id',
                'a.org_id',
                DB::raw("CASE WHEN a.interview_status = 'Selected' THEN 1 ELSE 0 END"),
                DB::raw("CASE WHEN a.interview_status IN ('Disqualify','Not Recruit') THEN 1 ELSE 0 END")
            ]);

        $aggQuery = DB::query()->fromSub($subQuery, 'sub')
            ->select(
                'sub.org_id',
                DB::raw('COUNT(*) as total_applicants'),
                DB::raw('SUM(CASE WHEN sub.has_done_assessment = 1 THEN 1 ELSE 0 END) as completed_assessments'),
                DB::raw('SUM(CASE WHEN sub.has_done_assessment = 0 THEN 1 ELSE 0 END) as pending_assessments'),
                DB::raw('SUM(CASE WHEN sub.has_done_assessment = 1 AND sub.is_selected = 1 THEN 1 ELSE 0 END) as selected_applicants'),
                DB::raw('SUM(CASE WHEN sub.has_done_assessment = 1 AND sub.is_rejected = 1 THEN 1 ELSE 0 END) as rejected_applicants')
            )
            ->groupBy('sub.org_id');

        return $aggQuery->get()->keyBy('org_id');
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

        $curAgg = $this->getMonthlyAgg($orgIds, $curYear, $curMonth);
        $prevAgg = $this->getMonthlyAgg($orgIds, $prevYear, $prevMonth);

        $cur = (object)[
            'total_applicants'        => 0,
            'selected_applicants'     => 0,
            'rejected_applicants'     => 0,
            'completed_assessments'   => 0,
            'pending_assessments'     => 0,
        ];

        $prev = clone $cur;

        foreach ($organizations as $org) {
            $c = $curAgg->get($org->id);
            $p = $prevAgg->get($org->id);

            $cur->total_applicants      += $c ? (int)$c->total_applicants : 0;
            $cur->completed_assessments += $c ? (int)$c->completed_assessments : 0;
            $cur->pending_assessments   += $c ? (int)$c->pending_assessments : 0;
            $cur->selected_applicants   += $c ? (int)$c->selected_applicants : 0;
            $cur->rejected_applicants   += $c ? (int)$c->rejected_applicants : 0;

            $prev->total_applicants      += $p ? (int)$p->total_applicants : 0;
            $prev->completed_assessments += $p ? (int)$p->completed_assessments : 0;
            $prev->pending_assessments   += $p ? (int)$p->pending_assessments : 0;
            $prev->selected_applicants   += $p ? (int)$p->selected_applicants : 0;
            $prev->rejected_applicants   += $p ? (int)$p->rejected_applicants : 0;
        }

        $pct = function ($now, $old) {
            if ($old == 0 && $old == $now) return 0;
            if ($old == 0) return $now > 0 ? 100 : 0;
            return round((($now - $old) / abs($old)) * 100, 1);
        };

        $companyWiseIPE = [];
        foreach ($organizations as $org) {
            $c = $curAgg->get($org->id);
            $p = $prevAgg->get($org->id);

            $companyWiseIPE[] = [
                'name'                  => $org->name,
                'short_name'            => $org->short_name ?: $org->name,
                'total_applicants'      => $c ? (int)$c->total_applicants : 0,
                'total_applicants_prev' => $p ? (int)$p->total_applicants : 0,
                'completed_assessments' => $c ? (int)$c->completed_assessments : 0,
                'completed_assessments_prev' => $p ? (int)$p->completed_assessments : 0,
                'pending_assessments'   => $c ? (int)$c->pending_assessments : 0,
                'pending_assessments_prev' => $p ? (int)$p->pending_assessments : 0,
                'selected_applicants'   => $c ? (int)$c->selected_applicants : 0,
                'selected_applicants_prev' => $p ? (int)$p->selected_applicants : 0,
                'rejected_applicants'   => $c ? (int)$c->rejected_applicants : 0,
                'rejected_applicants_prev' => $p ? (int)$p->rejected_applicants : 0,
            ];
        }
        $companyWiseIPE = array_values(array_filter($companyWiseIPE, function ($row) {
            return $row['total_applicants'] > 0
                || $row['total_applicants_prev'] > 0
                || $row['completed_assessments'] > 0
                || $row['completed_assessments_prev'] > 0;
        }));
        usort($companyWiseIPE, fn($a, $b) => $b['total_applicants'] <=> $a['total_applicants']);

        $totalChartApplicants    = array_sum(array_column($companyWiseIPE, 'total_applicants'));
        $totalChartCompleted     = array_sum(array_column($companyWiseIPE, 'completed_assessments'));
        $totalChartCompanies     = count($companyWiseIPE);

        return [
            'currentMonthName' => $currentMonth->format('F Y'),
            'prevMonthName'    => $prevMonthObj->format('F Y'),
            'totalCompanies'   => count($organizations),

            'companyWiseIPE'       => collect($companyWiseIPE)->values(),
            'totalChartApplicants' => $totalChartApplicants,
            'totalChartCompleted'  => $totalChartCompleted,
            'totalChartCompanies'  => $totalChartCompanies,

            'totalApplicants'       => $cur->total_applicants,
            'totalApplicantsPrev'   => $prev->total_applicants,
            'totalApplicantsDiff'   => $pct($cur->total_applicants, $prev->total_applicants),

            'completedAssessments'     => $cur->completed_assessments,
            'completedAssessmentsPrev' => $prev->completed_assessments,
            'completedAssessmentsDiff' => $pct($cur->completed_assessments, $prev->completed_assessments),

            'pendingAssessments'     => $cur->pending_assessments,
            'pendingAssessmentsPrev' => $prev->pending_assessments,
            'pendingAssessmentsDiff' => $pct($cur->pending_assessments, $prev->pending_assessments),

            'selectedApplicants'     => $cur->selected_applicants,
            'selectedApplicantsPrev' => $prev->selected_applicants,
            'selectedApplicantsDiff' => $pct($cur->selected_applicants, $prev->selected_applicants),

            'rejectedApplicants'     => $cur->rejected_applicants,
            'rejectedApplicantsPrev' => $prev->rejected_applicants,
            'rejectedApplicantsDiff' => $pct($cur->rejected_applicants, $prev->rejected_applicants),
        ];
    }

    /**
     * Display a listing of the resource.
     */
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

        return view('ipe::index', array_merge($dashboardData, compact('organizations', 'orgId')));
    }

    public function getDashboardAjax(Request $request)
    {
        $orgId = $this->resolveAccessibleOrgId($request->org_id);
        $dashboardData = $this->getDashboardData($orgId);
        return response()->json($dashboardData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ipe::create');
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
        return view('ipe::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ipe::edit');
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
