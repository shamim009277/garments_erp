<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\PartName;
use Modules\OrderManagement\Http\Requests\Setup\PartNameRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class PartNameController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:inventory.partnames.view')->only('index','show');
    //     $this->middleware('permission:inventory.partnames.add')->only('store');
    //     $this->middleware('permission:inventory.partnames.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.partnames.delete')->only('destroy');
    // }
   
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partNames = PartName::all();
        return view('ordermanagement::setup.partnames.index', compact('partNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.partnames.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartNameRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $partName = PartName::create([
                'part_name' => $request->part_name,
                'is_active' => $request->is_active,
                
            ]);
            // return $partName;
            DB::commit();
            return redirect()->route('ordermanagement.setup.partnames.index')->with('success', 'Part Name created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create part name: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $partName = PartName::findOrFail($id);
        return view('ordermanagement::setup.partnames.show', compact('partName'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partName = PartName::findOrFail($id);
        return view('ordermanagement::setup.partnames.edit', compact('partName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartNameRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $partName = PartName::findOrFail($id);
            $partName->update([
                'part_name' => $request->part_name,
                'is_active' => $request->is_active,
                
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.partnames.index')->with('success', 'Part Name updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update part name: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $partName = PartName::findOrFail($id);
            $partName->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.partnames.index')->with('success', 'Part Name deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete part name: ' . $e->getMessage());
        }
    }
}
