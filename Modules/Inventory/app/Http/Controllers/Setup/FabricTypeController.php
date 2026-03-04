<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\FabricType;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Modules\Inventory\Http\Requests\Setup\FabricTypeRequest;

class FabricTypeController extends Controller
{
    //         $table->string('fabric_type_code', 20)->unique(); // Like FT001
    //         $table->string('fabric_type_name', 100);
    //         $table->string('fabric_type_description')->nullable();
    //         $table->boolean('is_active')->default(true);
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:inventory.fabic-types.view')->only('index','show');
        $this->middleware('permission:inventory.fabic-types.add')->only('store');
        $this->middleware('permission:inventory.fabic-types.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:inventory.fabic-types.delete')->only('destroy');
    }



    public function index()
    {
        $fabictypes = FabricType::all();
        return view('inventory::setup.fabictypes.index', compact('fabictypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.fabictypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FabricTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            //fabric_type_code
            $prifix = 'FT';
            $length = 3;
            $fabricType = FabricType::create([
                'fabric_type_code' => $prifix . str_pad(FabricType::count() + 1, $length, '0', STR_PAD_LEFT),
                'fabric_type_name' => $request->fabric_type_name,
                'fabric_type_description' => $request->fabric_type_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.fabictypes.index')->with('success', 'Fabric Type created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create fabric type: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventory::setup.fabictypes.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fabricType = FabricType::findOrFail($id);
        return view('inventory::setup.fabictypes.edit', compact('fabricType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FabricTypeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $fabricType = FabricType::findOrFail($id);
            $fabricType->update([
                'fabric_type_name' => $request->fabric_type_name,
                'fabric_type_description' => $request->fabric_type_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.fabictypes.index')->with('success', 'Fabric Type updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update fabric type: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $fabricType = FabricType::findOrFail($id);
            $fabricType->delete();
            DB::commit();
            return redirect()->route('inventory.setup.fabictypes.index')->with('success', 'Fabric Type deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete fabric type: ' . $e->getMessage());
        }
    }
}
