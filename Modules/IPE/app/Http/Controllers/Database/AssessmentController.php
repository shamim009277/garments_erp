<?php

namespace Modules\IPE\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Degree;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Line;
use Modules\HRIS\Models\Setup\Organization;
use Modules\IPE\Http\Requests\Database\AssessmentRequest;
use Modules\IPE\Http\Requests\Database\ProcessStoreRequest;
use Modules\IPE\Models\Database\Assessment;
use Modules\IPE\Models\Database\AssessmentDetailsHelper;
use Modules\IPE\Models\Database\AssessmentProcess;
use Modules\IPE\Models\Setup\HelperQuestion;
use Modules\IPE\Models\Setup\Process;

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
        $lines = Line::active()->orderBy('code', 'asc')->pluck('line', 'code');

        $organizations = Organization::active()->pluck('short_name', 'id');
        //\DB::enableQueryLog();
        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation', 'organization:id,short_name', 'assessment:id,applicant_id'])
            ->active()
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->where('ipe_assessment_required', 1)
            ->get();

        $unique_applicant = [];
        //dd(\DB::getQueryLog());
        $unique_department = $pending_applicants->unique('department_id');
        return view('ipe::database.assessment.index', compact('departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines'));
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
    public function store(AssessmentRequest $request)
    {
        $request->validated();
        try {
            $data = $request->validated();
            $applicant = Applicant::find($data['applicant_id']);
            $data['department_id'] = $applicant->department_id;
            $data['entry_date'] = $applicant->entry_date;
            $data['org_id'] = $applicant->org_id;
            $data['exp_year'] = $applicant->exp_year ?? 0;
            $data['exp_month'] = $applicant->exp_month ?? 0;
            $data['exp_month'] = $applicant->exp_month ?? 0;
            $data['assessment_date'] = Carbon::now()->format('Y-m-d');
            $data['is_done'] = 0;

            Assessment::create($data);
            return redirect()->route('ipe.database.assessments.index')->with('success', 'Assessment created successfully');
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
        $lines = Line::active()->orderBy('code', 'asc')->pluck('line', 'code');

        $organizations = Organization::active()->pluck('short_name', 'id');
        //\DB::enableQueryLog();
        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation', 'organization:id,short_name', 'assessment:id,applicant_id'])
            ->active()
            ->whereHas('assessment')
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->where('ipe_assessment_required', 1)
            ->get();

        $unique_applicant = Assessment::with(['details', 'designation:id,designation', 'processes','processes.processName:id,process,process_name','department:id,department'])->where('id', $id)->first();
        //dd(\DB::getQueryLog());
        $unique_department = $pending_applicants->unique('department_id');
        $assessment = Assessment::find($id);
        $helper_questions = HelperQuestion::active()->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
        $assessments = AssessmentDetailsHelper::where('assessment_id', $id)->get();
        $processlist = Process::active()->pluck('process_name', 'id');

        return view('ipe::database.assessment.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'processlist'));
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
    public function update(Request $request, $id)
    {
        try {
            $assessment = Assessment::findOrFail($id);
            if($assessment ->is_done){
                return redirect()->back()->with('error', 'Cannot update a completed assessment');
            }
            $assessment->update($request->only('degree_id', 'exp_year', 'exp_month'));
            return redirect()->back()->with('success', 'Assessment updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update assessment: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       try {
            $assessment = Assessment::findOrFail($request->id);
            if($assessment->is_done){
                return response()->json(['success' => false, 'message' => 'Cannot delete a completed assessment']);
            }

            $assessment->details()->delete();
            $assessment->processes()->delete();

            $assessment->delete();

            return response()->json(['success' => true, 'message' => 'Assessment deleted successfully','redirect' => url('/ipe/database/assessments')]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment deletion failed: ' . $e->getMessage()]);
        }

    }

    public function destroyProcess(Request $request)
    {
        try {
            $process =AssessmentProcess::findOrFail($request->id);
            if($process->assessment->is_done){
                return response()->json(['success' => false, 'message' => 'Cannot delete process from a completed assessment']);
            }
            $process->delete();
            return response()->json(['success' => true, 'message' => 'Assessment Process deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment Process deletion failed: ' . $e->getMessage()]);
        }
    }

    public function completeAssessment(Request $request)
    {
        try {
            $assessment = Assessment::findOrFail($request->id);
            $assessment->update([
                'is_done' => !$assessment->is_done,
            ]);
            return response()->json(['success' => true, 'message' => 'Assessment status updated successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false,'message' => 'Assessment not found'], 404);
        } catch (\Throwable $e) {
            return response()->json(['success' => false,'message' => 'Assessment status update failed' ], 500);
        }
    }

    public function getSearch(Request $request) {
        try{
            $data = Assessment::where('applicant_id', $request->search)->first();
            return redirect()->route('ipe.database.assessments.show', $data->id)->with('success', 'Search completed successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Search failed: ' . $e->getMessage());
        }
    }

    public function storeQuestion(Request $request)
    {
        try {
            $assessmentId = $request->assessment_id;

            foreach ($request->question_id as $key => $questionId) {
                if (!$questionId) continue;
                AssessmentDetailsHelper::updateOrCreate(
                    [
                        'assessment_id' => $assessmentId,
                        'sl'  => $key,
                    ],
                    [
                        'question_id'  => $questionId,
                        'answer' => $request->answer_id[$key] ?? null,
                        'status' => $request->status[$key] ?? 0,
                        'is_active' => 1,
                    ]
                );
            }

            return response()->json(['success' => true, 'message' => 'Assessment created successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Degree deletion failed: ' . $e->getMessage()]);
        }
    }

    public function storeProcess(ProcessStoreRequest $request)
    {
        $request->validated();

        try {
            $capacity = Process::find($request->process_id)->capacity ?? 0;

            $data = $request->validated();
            $data['average'] = round(($data['cycle_one'] + $data['cycle_two'] + $data['cycle_three'] + $data['cycle_four'] + $data['cycle_five']) / 5);
            $data['smv'] = round(60 / ($data['average']), 3);
            $data['target'] = $capacity;
            $data['efficiency'] = $data['smv'] > 0 ? round($data['average'] / $capacity * 100, 3) : 0;
            $data['is_active'] = 1;

            AssessmentProcess::create($data);

            return response()->json(['success' => true, 'message' => 'Assessment Process created successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment Process creation failed: ' . $e->getMessage()]);
        }
    }

        public function pdf($id)
        {
            try {
                $assessment = Assessment::with(['details', 'designation:id,designation', 'processes','processes.processName:id,process,process_name','department:id,department','applicant:id,birth_date'])->findOrFail($id);
                $pdf = Pdf::loadView('ipe::database.assessment.pdf', compact('assessment'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('assessment.pdf');
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
            }
        }
}
