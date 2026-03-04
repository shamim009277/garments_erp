<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Setup\RackLocationRequest;
use Modules\Inventory\Models\Setup\RackLocation;
use Illuminate\Support\Facades\DB;

class RackLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
            // $table->string('rack_name', 100)->nullable();
            // $table->string('rack_code', 50)->unique();
            // $table->string('aisle', 50)->nullable();
            // $table->string('row', 20)->nullable();
            // $table->string('column', 20)->nullable();
            // $table->tinyInteger('floor_level')->nullable();
            // $table->unsignedBigInteger('store_line_id');
            // $table->text('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
            // $table->timestamps();
            // // foreign key
            // $table->foreign('store_line_id')
            //       ->references('id')->on('inventory_setup_store_line')
            //       ->onDelete('cascade');
     
    function __construct()
        {
            $this->middleware('permission:inventory.rack-locations.view')->only('index','show');
            $this->middleware('permission:inventory.rack-locations.add')->only('store');
            $this->middleware('permission:inventory.rack-locations.edit')->only(['edit', 'update','toggleStatus']);
            $this->middleware('permission:inventory.rack-locations.delete')->only('destroy');
        }









    public function index()
    {
        $rackLocations = RackLocation::all();
        return view('inventory::setup.racklocations.index', compact('rackLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.racklocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RackLocationRequest $request)
    {
        // dd($request->all());
        $prefix = 'RC';
        $length = 4;

    // Get last serial number with prefix
    $lastSerial = DB::table('inventory_setup_rack_locations')
        ->where('rack_code', 'like', $prefix . '%')
        ->orderBy('rack_code', 'desc')
        ->value('rack_code');

    // Extract number and increment
    if ($lastSerial) {
        $lastNumber = (int) substr($lastSerial, strlen($prefix));
    } else {
        $lastNumber = 0;
    }

    $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
        $rackLocation = new RackLocation;
        $rackLocation->rack_name = $request->rack_name;
        $rackLocation->rack_code = $prefix . $newNumber;
        $rackLocation->aisle = $request->aisle;
        $rackLocation->row = $request->row;
        $rackLocation->column = $request->column;
        $rackLocation->floor_level = $request->floor_level;
        $rackLocation->store_line_id = $request->store_line_id;
        $rackLocation->description = $request->description;
        $rackLocation->is_active = $request->is_active;
        $rackLocation->save();
        return redirect()->route('inventory.setup.racklocations.index')->with('success', 'Rack Location created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventory::setup.racklocations.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('inventory::setup.racklocations.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RackLocationRequest $request, $id)
    {
        $rackLocation = RackLocation::findOrFail($id);
        $rackLocation->update($request->validated());
        return redirect()->route('inventory.setup.racklocations.index')->with('success', 'Rack Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rackLocation = RackLocation::findOrFail($id);
        $rackLocation->delete();
        return redirect()->route('inventory.setup.racklocations.index')->with('success', 'Rack Location deleted successfully');
    }
}
