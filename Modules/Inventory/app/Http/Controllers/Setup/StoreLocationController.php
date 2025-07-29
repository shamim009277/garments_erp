<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Http\Requests\Setup\StoreLocationRequest;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreType;

class StoreLocationController extends Controller
{
    // $table->string('name', 100);
    // $table->string('store_code', 50)->unique();
    // $table->string('address_line_1');
    // $table->string('address_line_2')->nullable();
    // $table->string('city', 100);
    // $table->string('state', 100)->nullable();
    // $table->string('zip_code', 20)->nullable();
    // $table->string('country', 100);
    // $table->string('store_size', 20)->nullable();
    // $table->unsignedBigInteger('store_type_id');
    // $table->unsignedBigInteger('organization_id');
    // $table->string('owner_id', 50)->nullable();
    // $table->string('owner_name', 100)->nullable();
    // $table->decimal('latitude', 10, 8)->nullable();
    // $table->decimal('longitude', 11, 8)->nullable();
    // $table->string('contact_person', 100)->nullable();
    // $table->string('phone', 20)->nullable();
    // $table->string('email', 100)->nullable();
    // $table->boolean('is_active')->default(true);
    // $table->unsignedBigInteger('created_by')->nullable();
    // $table->unsignedBigInteger('updated_by')->nullable();
    // // foreign key
    // $table->foreign('store_type_id')
    //       ->references('id')->on('inventory_setup_storetype')
    //       ->onDelete('cascade');
    // $table->foreign('organization_id')
    //       ->references('id')->on('hris_setup_organizations')
    //       ->onDelete('cascade');            
    // $table->timestamps();
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storelocations = StoreLocation::paginate(10);
        $organizations = Organization::all();  
        $storetypes = StoreType::all();
        return view('inventory::setup.storelocations.index', compact('storelocations', 'organizations', 'storetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.storelocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request) {
        
        DB::beginTransaction();
        try {
            $prefix = 'SI';
            $length = 4;
            $lastSerial = DB::table('inventory_setup_store_locations')
                ->where('store_code', 'like', $prefix . '%')
                ->orderBy('store_code', 'desc')
                ->value('store_code');
            $lastNumber = (int) substr($lastSerial, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            $storeLocation = StoreLocation::create([
                'store_code' => $prefix . $newNumber,
                'name' => $request->name,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'store_size' => $request->store_size,
                'store_type_id' => $request->store_type_id,
                'organization_id' => $request->organization_id,
                'owner_id' => $request->owner_id,
                'owner_name' => $request->owner_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.storelocations.index')->with('success', 'Store Location created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Store Location: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $storeLocation = StoreLocation::findOrFail($id);
        return view('inventory::setup.storelocations.show', compact('storeLocation'));  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $storeLocation = StoreLocation::findOrFail($id);
        return view('inventory::setup.storelocations.edit', compact('storeLocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLocationRequest $request, $id) {
        $storeLocation = StoreLocation::findOrFail($id);
        $storeLocation->update($request->validated());
        return redirect()->route('inventory.setup.storelocations.index')->with('success', 'Store Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $storeLocation = StoreLocation::findOrFail($id);
        $storeLocation->delete();
        return redirect()->route('inventory.setup.storelocations.index')->with('success', 'Store Location deleted successfully');
    }
}
