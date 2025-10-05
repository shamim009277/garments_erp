<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Sex;
use App\Http\Controllers\Controller;
use Modules\HRIS\Http\Requests\Setup\SexRequest;
use App\Traits\ToggleStatus;

class SexController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.sex.view')->only('index');
        $this->middleware('permission:hris.sex.add')->only('store');
        $this->middleware('permission:hris.sex.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.sex.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sexes = Sex::all();
        return view('hris::setup.sex.index', compact('sexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SexRequest $request) {
        try {
            Sex::create($request->validated());
            return redirect()->back()->with('success', 'Sex created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sex creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SexRequest $request, $id) {
        try {
            $sex = Sex::findOrFail($id);
            $sex->update($request->validated());
            return redirect()->back()->with('success', 'Sex updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sex update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Sex::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Sex deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Sex deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Sex::class);
    }
}
