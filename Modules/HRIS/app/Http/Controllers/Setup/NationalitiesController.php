<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Nationalities;
use Modules\HRIS\Http\Requests\Setup\NationalitiesRequest;

class NationalitiesController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nationalities = Nationalities::all();
        return view('hris::setup.nationalities.index', compact('nationalities'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(NationalitiesRequest $request) {
        try {
            Nationalities::create($request->validated());
            return redirect()->route('hris.setup.nationalities.index')->with('success', 'Nationality created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create nationality: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NationalitiesRequest $request, $id) {
        try {
            $nationality = Nationalities::findOrFail($id);
            $nationality->update($request->validated());
            return redirect()->route('hris.setup.nationalities.index')->with('success', 'Nationality updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update nationality: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Nationalities::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Nationality deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Nationality deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Nationalities::class);
    }
}
