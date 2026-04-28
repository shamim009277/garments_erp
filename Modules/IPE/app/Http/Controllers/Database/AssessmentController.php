<?php

namespace Modules\IPE\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Degree;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Line;
use Modules\HRIS\Models\Setup\Organization;
use Modules\IPE\Http\Requests\Database\AssessmentRequest;
use Modules\IPE\Models\Database\Assessment;
use Modules\IPE\Models\Setup\HelperQuestion;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(18)->addDays(1)->format('d-m-Y');
        $departments = Department::active()->pluck('department', 'id');
        $designations = Designation::active()->pluck('designation', 'id');
        $degrees = Degree::active()->pluck('degree', 'id');
        $lines = Line::active()->orderBy('code','asc')->pluck('line', 'code');

        $organizations = Organization::active()->pluck('short_name', 'id');
        //\DB::enableQueryLog();
        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation','organization:id,short_name','assessment:id,applicant_id'])
            ->active()
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->where('ipe_assessment_required', 1)
            ->get();

        $unique_applicant = [];
        //dd(\DB::getQueryLog());
        $unique_department = $pending_applicants->unique('department_id');
        return view('ipe::database.assessment.index', compact('departments', 'designations', 'degrees', 'pending_applicants','unique_applicant','unique_department','today','organizations','maxDate','lines'));
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
    public function store(AssessmentRequest $request) {
        $request->validated();
        try {
            $data = $request->validated();
            $applicant = Applicant::find($data['applicant_id']);
            $data['department_id'] = $applicant->department_id;
            $data['entry_date'] = $applicant->entry_date;
            $data['org_id'] = $applicant->org_id;
            $data['exp_year'] = $applicant->exp_year??0;
            $data['exp_month'] = $applicant->exp_month??0;

            Assessment::create($data);
            return redirect()->route('ipe.database.assessment.index')->with('success', 'Assessment created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create assessment: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(18)->addDays(1)->format('d-m-Y');
        $departments = Department::active()->pluck('department', 'id');
        $designations = Designation::active()->pluck('designation', 'id');
        $degrees = Degree::active()->pluck('degree', 'id');
        $lines = Line::active()->orderBy('code','asc')->pluck('line', 'code');

        $organizations = Organization::active()->pluck('short_name', 'id');
        //\DB::enableQueryLog();
        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation','organization:id,short_name','assessment:id,applicant_id'])
            ->active()
            ->whereHas('assessment')
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->where('ipe_assessment_required', 1)
            ->get();

        $unique_applicant = Assessment::find($id);
        //dd(\DB::getQueryLog());
        $unique_department = $pending_applicants->unique('department_id');
        $assessment = Assessment::find($id);
        $helper_questions = HelperQuestion::active()->select('id','sl','question','question_bn','answer','answer_bn')->orderBy('sl')
                          ->orderBy('id')->get()->groupBy('sl');

        return view('ipe::database.assessment.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants','unique_applicant','unique_department','today','organizations','maxDate','lines','helper_questions'));
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

    public function getSearch(Request $request)
    {
        
    }
}
