<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\CostingHead;
use Modules\OrderManagement\Http\Requests\Setup\CostingHeadRequest;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CostingHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costingHeads = CostingHead::with('organization')->get();
        $organizations = Organization::all();
        
        return view('ordermanagement::setup.costingheads.index', compact('costingHeads', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('ordermanagement.setup.costingheads.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostingHeadRequest $request)
    {
        DB::beginTransaction();
        try {
            CostingHead::create([
                'costing_head_name' => $request->costing_head_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.costingheads.index')->with('success', 'Costing Head created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create costing head: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('ordermanagement.setup.costingheads.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return redirect()->route('ordermanagement.setup.costingheads.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostingHeadRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $costingHead = CostingHead::findOrFail($id);
            $costingHead->update([
                'costing_head_name' => $request->costing_head_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.costingheads.index')->with('success', 'Costing Head updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update costing head: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $costingHead = CostingHead::findOrFail($id);
            $costingHead->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.costingheads.index')->with('success', 'Costing Head deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete costing head: ' . $e->getMessage());
        }
    }
}
