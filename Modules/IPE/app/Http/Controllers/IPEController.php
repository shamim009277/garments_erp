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

        $applicantSelectRaw = '
            org_id,
            COUNT(*) as total_applicants,
            SUM(CASE WHEN final_status = 1 THEN 1 ELSE 0 END) as selected_applicants,
            SUM(CASE WHEN final_status IN (2, 3) THEN 1 ELSE 0 END) as rejected_applicants
        ';

        $curApplicantAgg = Applicant::withoutGlobalScopes()
            ->selectRaw($applicantSelectRaw)
            ->whereIn('org_id', $orgIds)
            ->where('ipe_assessment_required', true)
            ->whereYear('entry_date', $curYear)
            ->whereMonth('entry_date', $curMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $prevApplicantAgg = Applicant::withoutGlobalScopes()
            ->selectRaw($applicantSelectRaw)
            ->whereIn('org_id', $orgIds)
            ->where('ipe_assessment_required', true)
            ->whereYear('entry_date', $prevYear)
            ->whereMonth('entry_date', $prevMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $assessmentSelectRaw = '
            org_id,
            COUNT(*) as total_assessments,
            SUM(CASE WHEN is_done = 1 THEN 1 ELSE 0 END) as completed_assessments
        ';

        $curAssessmentAgg = Assessment::withoutGlobalScopes()
            ->selectRaw($assessmentSelectRaw)
            ->whereIn('org_id', $orgIds)
            ->whereYear('assessment_date', $curYear)
            ->whereMonth('assessment_date', $curMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $prevAssessmentAgg = Assessment::withoutGlobalScopes()
            ->selectRaw($assessmentSelectRaw)
            ->whereIn('org_id', $orgIds)
            ->whereYear('assessment_date', $prevYear)
            ->whereMonth('assessment_date', $prevMonth)
            ->groupBy('org_id')
            ->get()
            ->keyBy('org_id');

        $cur = (object)[
            'total_applicants'        => 0,
            'selected_applicants'     => 0,
            'rejected_applicants'     => 0,
            'completed_assessments'   => 0,
            'pending_assessments'     => 0,
            'total_assessments'       => 0,
        ];

        $prev = clone $cur;

        foreach ($organizations as $org) {
            $ca = $curApplicantAgg->get($org->id);
            $pa = $prevApplicantAgg->get($org->id);
            $cs = $curAssessmentAgg->get($org->id);
            $ps = $prevAssessmentAgg->get($org->id);

            $curTotalApp = $ca ? (int)$ca->total_applicants : 0;
            $curCompleted = $cs ? (int)$cs->completed_assessments : 0;
            $curTotalAss = $cs ? (int)$cs->total_assessments : 0;

            $prevTotalApp = $pa ? (int)$pa->total_applicants : 0;
            $prevCompleted = $ps ? (int)$ps->completed_assessments : 0;
            $prevTotalAss = $ps ? (int)$ps->total_assessments : 0;

            $cur->total_applicants      += $curTotalApp;
            $cur->selected_applicants   += $ca ? (int)$ca->selected_applicants : 0;
            $cur->rejected_applicants   += $ca ? (int)$ca->rejected_applicants : 0;
            $cur->total_assessments     += $curTotalAss;
            $cur->completed_assessments += $curCompleted;
            $cur->pending_assessments   += max(0, $curTotalApp - $curCompleted);

            $prev->total_applicants      += $prevTotalApp;
            $prev->selected_applicants   += $pa ? (int)$pa->selected_applicants : 0;
            $prev->rejected_applicants   += $pa ? (int)$pa->rejected_applicants : 0;
            $prev->total_assessments     += $prevTotalAss;
            $prev->completed_assessments += $prevCompleted;
            $prev->pending_assessments   += max(0, $prevTotalApp - $prevCompleted);
        }

        $pct = function ($now, $old) {
            if ($old == 0 && $old == $now) return 0;
            if ($old == 0) return $now > 0 ? 100 : 0;
            return round((($now - $old) / abs($old)) * 100, 1);
        };

        $companyWiseIPE = [];
        foreach ($organizations as $org) {
            $ca = $curApplicantAgg->get($org->id);
            $pa = $prevApplicantAgg->get($org->id);
            $cs = $curAssessmentAgg->get($org->id);
            $ps = $prevAssessmentAgg->get($org->id);

            $curTotalApp    = $ca ? (int)$ca->total_applicants : 0;
            $curCompleted   = $cs ? (int)$cs->completed_assessments : 0;
            $curSelected    = $ca ? (int)$ca->selected_applicants : 0;
            $prevTotalApp   = $pa ? (int)$pa->total_applicants : 0;
            $prevCompleted  = $ps ? (int)$ps->completed_assessments : 0;
            $prevSelected   = $pa ? (int)$pa->selected_applicants : 0;

            $companyWiseIPE[] = [
                'name'                  => $org->name,
                'short_name'            => $org->short_name ?: $org->name,
                'total_applicants'      => $curTotalApp,
                'total_applicants_prev' => $prevTotalApp,
                'completed_assessments' => $curCompleted,
                'completed_assessments_prev' => $prevCompleted,
                'pending_assessments'   => max(0, $curTotalApp - $curCompleted),
                'pending_assessments_prev' => max(0, $prevTotalApp - $prevCompleted),
                'selected_applicants'   => $curSelected,
                'selected_applicants_prev' => $prevSelected,
                'rejected_applicants'   => $ca ? (int)$ca->rejected_applicants : 0,
                'rejected_applicants_prev' => $pa ? (int)$pa->rejected_applicants : 0,
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
