<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\IPE\Http\Requests\Setup\HelperQuestionRequest;
use Modules\IPE\Models\Setup\HelperQuestion;
use App\Traits\ToggleStatus;

class HelperQuestionsController extends Controller
{
    use ToggleStatus;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $helperQuestions = HelperQuestion::active()->latest()->get();
        return view('ipe::setup.helperquestions.index', compact('helperQuestions'));
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
    public function store(HelperQuestionRequest $request) {
        try {
            HelperQuestion::create($request->validated());
            return redirect()->route('ipe.setup.helperquestions.index')->with('success', 'Helper question created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create helper question: ' . $e->getMessage());
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
    public function update(HelperQuestionRequest $request, $id) {
        try {
            HelperQuestion::find($id)->update($request->validated());
            return redirect()->route('ipe.setup.helperquestions.index')->with('success', 'Helper question updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update helper question: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            HelperQuestion::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Helper question deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Helper question deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, HelperQuestion::class);   
    }
}
