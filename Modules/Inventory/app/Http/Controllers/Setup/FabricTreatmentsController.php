<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\FabricTreatments;
use Modules\Inventory\Http\Requests\Setup\FabricTreatmentsRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class FabricTreatmentsController extends Controller
{
    // $table->string('fabric_treatment_code', 20)->unique(); // Like FT001
    // $table->string('fabric_treatment_name', 100);
    // $table->string('fabric_treatment_description')->nullable();
    // $table->boolean('is_active')->default(true);
    use ToggleStatus;
    public function index()
    {
        $fabricTreatments = FabricTreatments::all();
        return view('inventory::setup.fabictreatments.index', compact('fabricTreatments')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.fabictreatments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FabricTreatmentsRequest $request)
    {
        DB::beginTransaction();
        try {
            $prifix = 'FT';
            $length = 3;
            $fabricTreatment = FabricTreatments::create([
                'fabric_treatment_code' => $prifix . str_pad(FabricTreatments::count() + 1, $length, '0', STR_PAD_LEFT),
                'fabric_treatment_name' => $request->fabric_treatment_name,
                'fabric_treatment_description' => $request->fabric_treatment_description,
                'is_active' => $request->is_active,
            ]); 
            DB::commit();
            return redirect()->route('inventory.setup.fabictreatments.index')->with('success', 'Fabric Treatment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Fabric Treatment: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $fabricTreatment = FabricTreatments::findOrFail($id);
        return view('inventory::setup.fabictreatments.show', compact('fabricTreatment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fabricTreatment = FabricTreatments::findOrfail($id);
        return view('inventory::setup.fabictreatments.edit', compact('fabricTreatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FabricTreatmentsRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $fabricTreatment = FabricTreatments::findOrFail($id);
            $fabricTreatment->update($request->all());
            DB::commit();
            return redirect()->route('inventory.setup.fabictreatments.index')->with('success', 'Fabric Treatment updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Fabric Treatment: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $fabricTreatment = FabricTreatments::findOrFail($id);
            $fabricTreatment->delete();
            DB::commit();
            return redirect()->route('inventory.setup.fabictreatments.index')->with('success', 'Fabric Treatment deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete Fabric Treatment: ' . $e->getMessage());
        }
    }
}
