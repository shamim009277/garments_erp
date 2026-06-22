<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\HRIS\Http\Requests\Setup\CompanyUnitRequest;
use Modules\HRIS\Models\Setup\CompanyUnit;
use Modules\HRIS\Models\Setup\Line;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\Unit;

class CompanyUnitController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $unitlist = Unit::pluck('unit', 'code')->toArray();
        $units = CompanyUnit::with('company:id,short_name')->latest()->get();
        // $existLines = collect($units)->pluck('line_id')->toArray();
        // $decoded = array_map(fn($v) => json_decode($v, true), $existLines);
        // $merged = array_merge(...$decoded);
        //$lines = Line::whereNotIn('code', $merged)->active()->pluck('line', 'code')->toArray();
        $lines = Line::whereNot('code', '0')->active()->pluck('line', 'code')->toArray();
        return view('hris::setup.companyunit.index', compact('lines', 'units', 'organizations', 'unitlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(CompanyUnitRequest $request) {
    //     $unit = Unit::where('code', $request->code)->first();
    //     $line = Line::whereIn('code', $request->line_id)->pluck('line')->toArray();
    //     try {
    //         $validated = $request->validated();
    //         $validated['unit'] = $unit->unit;
    //         $validated['line_id'] = json_encode($validated['line_id']);
    //         $validated['line'] = json_encode($line);
    //         CompanyUnit::create($validated);
    //         return redirect()->route('hris.setup.companyunits.index')->with('success', 'Unit assign created successfully');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to create union: ' . $e->getMessage());
    //     }
    // }

    public function store(CompanyUnitRequest $request)
    {
        try {

            $validated = $request->validated();

            $unit = Unit::where('code', $validated['code'])->firstOrFail();

            $lines = Line::whereIn('code', $validated['line_id'])
                ->pluck('line')
                ->toArray();

            $validated['unit'] = $unit->unit;
            $validated['line'] = $lines;

            CompanyUnit::create($validated);

            return redirect()
                ->route('hris.setup.companyunits.index')
                ->with('success', 'Unit assign created successfully');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create unit assignment: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id) {}
    public function update(CompanyUnitRequest $request,CompanyUnit $companyunit) {
        try {

            $validated = $request->validated();
            $unit = Unit::where('code', $validated['code'])->firstOrFail();
            $lines = Line::whereIn('code', $validated['line_id'])
                ->pluck('line')
                ->toArray();

            $validated['unit'] = $unit->unit;
            $validated['line'] = $lines;

            $companyunit->update($validated);

            return redirect()
                ->route('hris.setup.companyunits.index')
                ->with('success', 'Unit assign updated successfully');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update unit assignment: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            CompanyUnit::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Unit assign deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Unit assign deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, CompanyUnit::class);
    }
}
