<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\StoreLine;
use Modules\Inventory\Http\Requests\Setup\StoreLineRequest;
use Illuminate\Support\Facades\DB;

class StoreLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $table->string('line_code', 50)->unique();
        // $table->string('name', 100);
        // $table->text('description')->nullable();
        // $table->boolean('is_active')->default(true);
        $storelines = StoreLine::all();
        return view('inventory::setup.storelines.index', compact('storelines'));
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
    public function store(StoreLineRequest $request) {
        $prefix = 'SL';
        $length = 4;

    // Get last serial number with prefix
    $lastSerial = DB::table('inventory_setup_store_line')
        ->where('line_code', 'like', $prefix . '%')
        ->orderBy('line_code', 'desc')
        ->value('line_code');

    // Extract number and increment
    if ($lastSerial) {
        $lastNumber = (int) substr($lastSerial, strlen($prefix));
    } else {
        $lastNumber = 0;
    }

    $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
        $storeline = new StoreLine;
        $storeline->line_code = $prefix . $newNumber;
        $storeline->name = $request->name;
        $storeline->description = $request->description;
        $storeline->is_active = $request->is_active;
        // $storeline->created_by = auth()->user()->id;
        // $storeline->updated_by = auth()->user()->id
        $storeline->save();        
        
        // dd($storeline);
        return redirect()->route('inventory.setup.storelines.index')->with('success', 'Store Line Created Successfully');
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
        return view('inventory::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLineRequest $request, $id) {
        $storeline = StoreLine::findOrFail($id);
        $storeline->update($request->all());
        return redirect()->route('inventory.setup.storelines.index')->with('success', 'Store Line updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {        
        $storeline = StoreLine::findOrFail($id);
        $storeline->delete();
        return redirect()->route('inventory.setup.storelines.index')->with('success', 'Store Line deleted successfully');
    }   
}
