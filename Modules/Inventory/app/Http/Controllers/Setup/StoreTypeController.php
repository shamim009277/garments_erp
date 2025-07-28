<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Setup\StoreTypeRequest;
use Modules\Inventory\Models\Setup\StoreType;
use Illuminate\Support\Facades\DB;
class StoreTypeController extends Controller
{
            // $table->string('type_code', 50)->unique();
            // $table->string('name', 100);
            // $table->text('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storetypes = StoreType::paginate(10);
        return view('inventory::setup.storetypes.index', compact('storetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request) {
        $prefix = 'ST';
        $length = 4;

    // Get last serial number with prefix
    $lastSerial = DB::table('inventory_setup_storetype')
        ->where('type_code', 'like', $prefix . '%')
        ->orderBy('type_code', 'desc')
        ->value('type_code');

    // Extract number and increment
    if ($lastSerial) {
        $lastNumber = (int) substr($lastSerial, strlen($prefix));
    } else {
        $lastNumber = 0;
    }

    $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
        $storetype = new StoreType;
        $storetype->type_code = $prefix . $newNumber;
        $storetype->name = $request->name;
        $storetype->description = $request->description;
        $storetype->is_active = $request->is_active;
        // $storetype->created_by = auth()->user()->id;
        // $storetype->updated_by = auth()->user()->id
        $storetype->save();        
        
        // dd($storetype);
        return redirect()->route('inventory.setup.storetypes.index')->with('success', 'Store Type Created Successfully');
    }
        
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $storetype = StoreType::findOrFail($id);
        return view('inventory::setup.storetypes.edit', compact('storetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTypeRequest $request, $id) {
        $storetype = StoreType::findOrFail($id);
        $storetype->update($request->all());
        return redirect()->route('inventory.setup.storetypes.index')->with('success', 'Store Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $storetype = StoreType::findOrFail($id);
        $storetype->delete();
        return redirect()->route('inventory.setup.storetypes.index')->with('success', 'Store Type Deleted Successfully');
    }
}
