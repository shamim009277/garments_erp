<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Department;
use Modules\IPE\Http\Requests\Setup\QualityQuestionRequest;
use Modules\IPE\Models\Setup\QualityQuestion;

class QualityQuestionsController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qualityquestions = QualityQuestion::with(['department:id,department'])->latest()->get();
        $departmnetlist = Department::active()->whereIn('id',[9,11,20])->select('id','department')->get();
        $lists = collect($departmnetlist)->pluck('department', 'id');
        return view('ipe::setup.qualityquestions.index', compact('qualityquestions','departmnetlist','lists'));
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
    public function store(QualityQuestionRequest $request) {
        try {
            QualityQuestion::create($request->validated());
            return redirect()->route('ipe.setup.qualityquestions.index')->with('success', 'Quality question created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create packing question: ' . $e->getMessage());
        }
    }

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
    public function update(QualityQuestionRequest $request, $id) {
        try {
            $qualityQuestion = QualityQuestion::find($id);
            $qualityQuestion->update($request->validated());
            return redirect()->route('ipe.setup.qualityquestions.index')->with('success', 'Quality question updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update quality question: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            QualityQuestion::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Quality question deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Quality question deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, QualityQuestion::class);
    }
}
