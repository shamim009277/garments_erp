<?php

namespace App\Http\Controllers\Master\Setup;

use Illuminate\Http\Request;
use App\Models\Master\Setup\Unit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Setup\UnitRequest;
use App\Traits\ToggleStatus;

class UnitsController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:master.units.view')->only('index');
        $this->middleware('permission:master.units.add')->only('store');
        $this->middleware('permission:master.units.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:master.units.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rots = Unit::active()->where('is_root', 1)->pluck('name', 'id')->toArray();
        $units = Unit::active()->with('children')->get();
        return view('master.setup.unit.index', compact('rots', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        try {
            $data = $request->all();
            $data['is_root'] = $request->root_id ? 0 : 1;
            Unit::create($data);
            return redirect()->route('master.setup.unit.index')->with('success', 'Unit created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create unit: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->update($request->validated());
            $unit->is_root = $request->root_id ? 0 : 1;
            $unit->save();
            return redirect()->route('master.setup.unit.index')->with('success', 'Unit updated successfully');
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
            return response()->json(['success' => false, 'message' => 'Unit deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Unit::class);
    }
}
