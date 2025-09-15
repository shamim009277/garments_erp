<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Line;
use App\Http\Controllers\Controller;
use Modules\HRIS\Http\Requests\Setup\LineRequest;
use App\Traits\ToggleStatus;

class LineController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.line.view')->only('index');
        $this->middleware('permission:hris.line.add')->only('store');
        $this->middleware('permission:hris.line.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.line.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lines = Line::latest()->get();
        return view('hris::setup.line.index', compact('lines'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(LineRequest $request) {
        try {
            Line::create($request->validated());
            return redirect()->route('hris.setup.lines.index')->with('success', 'Line created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create line: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        try {
            $line = Line::findOrFail($id);
            $line->update($request->validated());
            return redirect()->route('hris.setup.lines.index')->with('success', 'Line updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update line: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Line::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Line deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Line deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Line::class);
    }
}
