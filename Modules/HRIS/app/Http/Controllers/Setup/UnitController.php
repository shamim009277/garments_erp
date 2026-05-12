<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Line;
use Modules\HRIS\Models\Setup\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Http\Requests\Setup\UnitRequest;
use App\Traits\ToggleStatus;


class UnitController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.unit.view')->only('index');
        $this->middleware('permission:hris.unit.add')->only('store');
        $this->middleware('permission:hris.unit.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.unit.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest()->get();
        $existLines = collect($units)->pluck('line_id')->toArray();
        $decoded = array_map(fn($v) => json_decode($v, true), $existLines);
        $merged = array_merge(...$decoded);
        $lines = Line::whereNotIn('code', $merged)->active()->pluck('line', 'code')->toArray();
        return view('hris::setup.unit.index', compact('lines', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request) {
        $lines = Line::whereIn('code', $request->line_id)->pluck('line')->toArray();
        try {
            $data = $request->validated();
            $data['line_id'] = json_encode($request->line_id);
            $data['line'] = json_encode($lines);
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            Unit::create($data);
            return redirect()->route('hris.setup.units.index')->with('success', 'Unit created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create unit: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, $id) {
        try {
            $unit = Unit::findOrFail($id);
            $unit->update($request->validated());
            return redirect()->route('hris.setup.units.index')->with('success', 'Unit updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update unit: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Unit::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Unit deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete unit: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->toggleStatusTrait($request, Unit::class);
    }
}
