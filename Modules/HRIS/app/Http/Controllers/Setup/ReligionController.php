<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Religion;
use Modules\HRIS\Http\Requests\Setup\ReligionRequest;
use App\Traits\ToggleStatus;

class ReligionController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.religions.view')->only('index');
        $this->middleware('permission:hris.religions.add')->only('store');
        $this->middleware('permission:hris.religions.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.religions.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religions = Religion::all();
        return view('hris::setup.religions.index', compact('religions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReligionRequest $request) {
        try {
            Religion::create($request->validated());
            return redirect()->route('hris.setup.religions.index')->with('success', 'Religion created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create religion: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ReligionRequest $request,$id) {
        try {
            $religion = Religion::findOrFail($id);
            $religion->update($request->validated());
            return redirect()->route('hris.setup.religions.index')->with('success', 'Religion updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update religion: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Religion::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Religion deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Religion deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Religion::class);
    }
}
