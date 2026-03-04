<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\Accessories;
use Modules\OrderManagement\Http\Requests\Setup\AccessoriesRequest;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories = Accessories::with('organization')->get();
        $organizations = Organization::all();
        
        return view('ordermanagement::setup.accessories.index', compact('accessories', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('ordermanagement.setup.accessories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccessoriesRequest $request)
    {
        DB::beginTransaction();
        try {
            Accessories::create([
                'accessories_name' => $request->accessories_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.accessories.index')->with('success', 'Accessories created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create accessories: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('ordermanagement.setup.accessories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return redirect()->route('ordermanagement.setup.accessories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccessoriesRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $accessories = Accessories::findOrFail($id);
            $accessories->update([
                'accessories_name' => $request->accessories_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.accessories.index')->with('success', 'Accessories updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update accessories: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $accessories = Accessories::findOrFail($id);
            $accessories->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.accessories.index')->with('success', 'Accessories deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete accessories: ' . $e->getMessage());
        }
    }
}
