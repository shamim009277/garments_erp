<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\EducationBoard;
use Modules\HRIS\Http\Requests\Setup\EducationBoardRequest;
use App\Traits\ToggleStatus;

class EducationBoardController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationboards = EducationBoard::all();
        return view('hris::setup.educationboard.index', compact('educationboards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationBoardRequest $request) {
        try {
            EducationBoard::create($request->validated());
            return redirect()->route('hris.setup.educationboards.index')->with('success', 'Education Board created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create education board: ' . $th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EducationBoardRequest $request, $id) {
        try {
            $educationboard = EducationBoard::findOrFail($id);
            $educationboard->update($request->validated());
            return redirect()->route('hris.setup.educationboards.index')->with('success', 'Education Board updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update education board: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            EducationBoard::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Education Board deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Education Board deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, EducationBoard::class);
    }
}
