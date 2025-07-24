<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Degree;
use Modules\HRIS\Http\Requests\Setup\DegreeRequest;
use App\Traits\ToggleStatus;

class DegreeController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degrees = Degree::latest()->get();
        return view('hris::setup.degree.index', compact('degrees'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeRequest $request) {
        try {
            Degree::create($request->validated());
            return redirect()->back()->with('success', 'Degree created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Degree creation failed: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeRequest $request, $id) {
        try {
            $degree = Degree::findOrFail($id);
            $degree->update($request->validated());
            return redirect()->back()->with('success', 'Degree updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Degree update failed: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Degree::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Degree deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Degree deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Degree::class);
    }
}
