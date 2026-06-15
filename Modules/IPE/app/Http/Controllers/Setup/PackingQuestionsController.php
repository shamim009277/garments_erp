<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\IPE\Http\Requests\Setup\PackingQuestionRequest;
use Modules\IPE\Models\Setup\PackingQuestion;
use App\Traits\ToggleStatus;

class PackingQuestionsController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packingQuestions = PackingQuestion::latest()->get();
        return view('ipe::setup.packingquestions.index', compact('packingQuestions'));
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
    public function store(PackingQuestionRequest $request) {
         try {
            PackingQuestion::create($request->validated());
            return redirect()->route('ipe.setup.packingquestions.index')->with('success', 'Packing question created successfully');
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
    public function update(PackingQuestionRequest $request, $id) {
        try {
            $packingQuestion = PackingQuestion::find($id);
            $packingQuestion->update($request->validated());
            return redirect()->route('ipe.setup.packingquestions.index')->with('success', 'Packing question updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update packing question: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            PackingQuestion::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Packing question deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Helper question deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, PackingQuestion::class);
    }
}
