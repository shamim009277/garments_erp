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
use Modules\IPE\Http\Requests\Database\MachineProcessStoreRequest;
use Modules\IPE\Http\Requests\Database\ProcessStoreRequest;
use Modules\IPE\Models\Database\Assessment;
use Modules\IPE\Models\Database\AssessmentDetailsHelper;
use Modules\IPE\Models\Database\AssessmentDetailsQuality;
use Modules\IPE\Models\Database\AssessmentMachineProcess;
use Modules\IPE\Models\Database\AssessmentProcess;
use Modules\IPE\Models\Setup\AssessmentGroup;
use Modules\IPE\Models\Setup\HelperQuestion;
use Modules\IPE\Models\Setup\MachineProcess;
use Modules\IPE\Models\Setup\MachineType;
use Modules\IPE\Models\Setup\PackingQuestion;
use Modules\IPE\Models\Setup\Process;
use Modules\IPE\Models\Setup\QualityQuestion;

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
        $data = $request->validated();
        // check group
        $applicant = Applicant::find($data['applicant_id']);
        $groups = AssessmentGroup::active()->where('designation_id', $applicant->designation_id)->first();

        if (!$groups) {
            return redirect()->back()->with('error', 'Group not found for this department');
        }

        try {
            $data['department_id'] = $applicant->department_id;
            $data['entry_date'] = $applicant->entry_date;
            $data['org_id'] = $applicant->org_id;
            $data['exp_year'] = $data['exp_year'] ?? 0;
            $data['exp_month'] = $data['exp_month'] ?? 0;
            $data['assessment_date'] = Carbon::now()->format('Y-m-d');
            $data['is_done'] = 0;

            $assessment = Assessment::create($data);
            return redirect()->route('ipe.database.assessments.show', $assessment->id)->with('success', 'Assessment created successfully');
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

        $unique_applicant = Assessment::with(['details', 'designation:id,designation', 'applicant:id,designation_id,determined_salary,final_designation_id,joining_date,interview_status', 'applicant.department:id,department', 'applicant.designation:id,designation', 'applicant.organization:id,short_namesses', 'processes.processName:id,process,process_name', 'department:id,department'])->where('id', $id)->first();
        $existhelpersl = $unique_applicant->details->pluck('sl')->toArray();

        $unique_department = $pending_applicants->unique('department_id');
        $assessment = Assessment::find($id);
        $helper_questions = HelperQuestion::active()->whereIn('sl', $existhelpersl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
        $assessments = AssessmentDetailsHelper::where('assessment_id', $id)->get();
    
        $groups = AssessmentGroup::active()->where('designation_id', $unique_applicant->designation_id)->first();

        if ($groups->code == 'H - 109') {

            return view('ipe::database.assessment.helpergeneral.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions'));
        } else if ($groups->code == 'HWP - 234') {
            $existid = $unique_applicant->processes->pluck('process_id')->toArray();
            $processlist = Process::active()->whereNotIn('id', $existid)->pluck('process_name', 'id');
            $getmarks = round(($unique_applicant->processes->avg('efficiency') ?? 0) * 0.70, 2);

            return view('ipe::database.assessment.helperprocess.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'processlist','getmarks'));
        }else if($groups->code == 'QC - 932'){
            $existqualityl = $unique_applicant->detailsQuality()->pluck('sl')->toArray();
            $quality_questions = QualityQuestion::active()->whereIn('sl', $existqualityl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');

            return view('ipe::database.assessment.quality.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'quality_questions'));
        }else if($groups->code == 'H - 834'){
            $machine = MachineType::active()
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->id => "{$item->name}"
                    ];
                });
            $getmarks = round(($unique_applicant->processes->avg('efficiency') ?? 0) * 0.70, 2);

            return view('ipe::database.assessment.operator.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions','getmarks','machine'));
        }

        // if (!$groups) {
        //     return view('ipe::database.assessment.default', compact('unique_applicant', 'pending_applicants'));
        // }

        // if ($groups->code == 'HG - 930') {
        //     return view('ipe::database.assessment.show', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'processlist'));
        // } else if ($groups->code == 'HGG - 614') {
        // }

        //$pacquestionds = PackingQuestion::active()->select('id','sl','type','question','question_bn','answer','answer_bn')->orderBy('type')->orderBy('sl')->orderBy('id')->get()->groupBy(['type', 'sl']);
        //$packgen_questionds = $pacquestionds->get(1, collect());
        //$packpractical_questionds = $pacquestionds->get(2, collect());

        //dd($pacquestionds, $packgen_questionds, $packpractical_questionds);

        //return view('ipe::database.assessment.helpergeneral', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'processlist'));

        return view('ipe::database.assessment.helper', compact('assessment', 'departments', 'designations', 'degrees', 'pending_applicants', 'unique_applicant', 'unique_department', 'today', 'organizations', 'maxDate', 'lines', 'helper_questions', 'processlist', 'packgen_questionds', 'packpractical_questionds'));
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
            if ($request->filled('status')) {
                $assessment = Assessment::findOrFail($id);
                if (!$assessment->is_done) {
                    return redirect()->back()->with('error', 'Cannot update a pending assessment');
                }
                $applicant = $assessment->applicant;

                $applicant->update([
                    'interview_status' => $request->interview_status,
                    'joining_date' => $request->joining_date,
                    'determined_salary' => $request->determined_salary ?? 0,
                    'file_entry' => 'Y',
                ]);

                return redirect()->route('ipe.database.assessments.index')->with('success', 'Assessment updated successfully');

            } else {
                $assessment = Assessment::findOrFail($id);
                if ($assessment->is_done) {
                    return redirect()->back()->with('error', 'Cannot update a completed assessment');
                }
                $assessment->update($request->only('degree_id', 'exp_year', 'exp_month'));
                return redirect()->back()->with('success', 'Assessment updated successfully');
            }
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
            if ($assessment->is_done) {
                return response()->json(['success' => false, 'message' => 'Cannot delete a completed assessment']);
            }

            $assessment->details()->delete();
            $assessment->processes()->delete();
            $assessment->machineProcesses()->delete();

            $assessment->delete();

            return response()->json(['success' => true, 'message' => 'Assessment deleted successfully', 'redirect' => url('/ipe/database/assessments')]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment deletion failed: ' . $e->getMessage()]);
        }
    }

    public function destroyProcess(Request $request)
    {
        try {
            $process = AssessmentProcess::findOrFail($request->id);
            if ($process->assessment->is_done) {
                return response()->json(['success' => false, 'message' => 'Cannot delete process from a completed assessment']);
            }
            $process->delete();
            return response()->json(['success' => true, 'message' => 'Assessment Process deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment Process deletion failed: ' . $e->getMessage()]);
        }
    }

    public function destroyMachineProcess(Request $request)
    {
        try {
            $process = AssessmentMachineProcess::findOrFail($request->id);
            if ($process->assessment->is_done) {
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
            //check group
            $groups = AssessmentGroup::active()->where('designation_id', $assessment->designation_id)->first();
            if (!$groups) {
                return response()->json(['success' => false, 'message' => 'Assessment not found'], 404);
            }

            if ($groups->code == 'H - 109') {
                $existhelpersl = $assessment->details->pluck('sl')->toArray();
                $helper_questions = HelperQuestion::active()->whereIn('sl', $existhelpersl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
                $total_marks = $helper_questions->count() * 10;
                $get_marks = $assessment->details->where('status', 1)->count() * 10;
                $efficiency = $get_marks / $total_marks * 100;

                $assessment->update([
                    'total_marks' => $total_marks,
                    'get_marks' => $get_marks,
                    'efficiency' => $efficiency,
                    'is_done' => !$assessment->is_done,
                ]);
            }else if ($groups->code == 'HWP - 234') {
                $existhelpersl = $assessment->details->pluck('sl')->toArray();
                $helper_questions = HelperQuestion::active()->whereIn('sl', $existhelpersl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
                $total_marks = $helper_questions->count() * 3 + 70;
                $genmarks = $assessment->details->where('status', 1)->count() * 3;
                $efficiencyen = round($genmarks / ($helper_questions->count() * 3) * 100, 2);

                $pracmarks = round(($assessment->processes->avg('efficiency') ?? 0) * 0.70, 2);
                $pracefficiency = $assessment->processes->avg('efficiency');

                $assessment->update([
                    'total_marks' => $total_marks,
                    'get_marks' => $genmarks+$pracmarks,
                    'efficiency' => round(($efficiencyen+$pracefficiency)/2,2),
                    'is_done' => !$assessment->is_done,
                ]);
            }else if($groups->code == 'QC - 932'){
                $existhelpersl = $assessment->details->pluck('sl')->toArray();
                $helper_questions = HelperQuestion::active()->whereIn('sl', $existhelpersl)->whereInselect('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
                $marks = $helper_questions->count() * 3;
                $genmarks = $assessment->details->where('status', 1)->count() * 3;
                $efficiencyen = round($genmarks / ($helper_questions->count() * 3) * 100, 2);

                $existqualitysl = $assessment->detailsQuality->pluck('sl')->toArray();
                $quality_questions = QualityQuestion::active()->whereIn('sl', $existqualitysl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
                $marks2 = $quality_questions->count() * 7;
                $genmarks2 = $assessment->detailsQuality->where('status', 1)->count() * 7;
                $efficiency1 = round($genmarks2 / ($quality_questions->count() * 7) * 100, 2);

                $total_marks = $marks + $marks2;
                $get_marks = $genmarks + $genmarks2;
                $efficiency = round(($efficiencyen+$efficiency1)/2,2);

                $assessment->update([
                    'total_marks' => $total_marks,
                    'get_marks' => $get_marks,
                    'efficiency' => $efficiency,
                    'is_done' => !$assessment->is_done,
                ]);
            }else if($groups->code == 'H - 834'){
                $existhelpersl = $assessment->details->pluck('sl')->toArray();
                $helper_questions = HelperQuestion::active()->whereIn('sl', $existhelpersl)->select('id', 'sl', 'question', 'question_bn', 'answer', 'answer_bn')->orderBy('sl')->orderBy('id')->get()->groupBy('sl');
                $total_marks = $helper_questions->count() * 3 + 70;
                $genmarks = $assessment->details->where('status', 1)->count() * 3;
                $efficiencyen = round($genmarks / ($helper_questions->count() * 3) * 100, 2);

                $pracmarks = round(($assessment->MachineProcesses->avg('efficiency') ?? 0) * 0.70, 2);
                $pracefficiency = $assessment->MachineProcesses->avg('efficiency');

                $assessment->update([
                    'total_marks' => $total_marks,
                    'get_marks' => $genmarks+$pracmarks,
                    'efficiency' => round(($efficiencyen+$pracefficiency)/2,2),
                    'is_done' => !$assessment->is_done,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Assessment status updated successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Assessment not found'], 404);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment status update failed'], 500);
        }
    }

    public function getSearch(Request $request)
    {
        try {
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

    public function storeQualityQuestion(Request $request)
    {
        try {
            $assessmentId = $request->assessment_id;
            foreach ($request->question_id as $key => $questionId) {
                if (!$questionId) continue;
                AssessmentDetailsQuality::updateOrCreate(
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

    public function storeMachineProcess(MachineProcessStoreRequest $request)
    {
        $request->validated();

        try {
            $capacity = MachineProcess::find($request->process_id)->capacity ?? 0;
            $machineId = MachineProcess::find($request->process_id)->type_id ?? 0;

            $data = $request->validated();
            $data['average'] = round(($data['cycle_one'] + $data['cycle_two'] + $data['cycle_three'] + $data['cycle_four'] + $data['cycle_five']) / 5);
            $data['smv'] = round(60 / ($data['average']), 3);
            $data['target'] = $capacity;
            $data['machine_id'] = $machineId;
            $data['efficiency'] = $data['smv'] > 0 ? round($data['average'] / $capacity * 100, 3) : 0;
            $data['is_active'] = 1;

            AssessmentMachineProcess::create($data);

            return response()->json(['success' => true, 'message' => 'Assessment Process created successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment Process creation failed: ' . $e->getMessage()]);
        }
    }

    public function pdf($id)
    {
        try {
            $assessment = Assessment::with(['details', 'designation:id,designation,grade', 'department:id,department', 'applicant:id,birth_date'])->findOrFail($id);

            $groups = AssessmentGroup::active()->where('designation_id', $assessment->designation_id)->first();
            if (!$groups) {
                return response()->json(['success' => false, 'message' => 'Assessment not found'], 404);
            }

            if ($groups->code == 'H - 109') {
                $pdf = Pdf::loadView('ipe::database.assessment.helpergeneral.pdf', compact('assessment'))->setPaper('a4', 'portrait');
            } else if ($groups->code == 'HWP - 234') {
                $pdf = Pdf::loadView('ipe::database.assessment.helperprocess.pdf', compact('assessment'))->setPaper('a4', 'portrait');
            } else if($groups->code == 'QC - 932'){
                $pdf = Pdf::loadView('ipe::database.assessment.quality.pdf', compact('assessment'))->setPaper('a4', 'portrait');
            } else if($groups->code == 'H - 834'){
                $pdf = Pdf::loadView('ipe::database.assessment.operator.pdf', compact('assessment'))->setPaper('a4', 'portrait');
            }

            return $pdf->stream('assessment.pdf');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    public function getMachineProcess($machineId)
    {
        try {
            //$processes = MachineProcess::where('type_id', $machineId)->get()->pluck('process_name', 'id')->toArray();

            $processType = [
                1 => 'Basic',
                2 => 'Semi Critical',
                3 => 'Critical',
            ];

            $processes = MachineProcess::active()
                ->where('type_id', $machineId)
                ->get()
                ->mapWithKeys(function ($process) use ($processType) {
                    return [
                        $process->id => ($processType[$process->process_type] ?? 'Unknown')
                            . ' - '
                            . $process->process_name
                    ];
                });
            return response()->json(['success' => true, 'message' => 'Assessment Process found successfully', 'data' => $processes]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Assessment Process not found: ' . $e->getMessage()]);
        }
    }
}
