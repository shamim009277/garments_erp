<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\Supplier;
use Modules\Inventory\Models\Setup\SupplierType;

use Modules\Inventory\Http\Requests\Setup\SupplierRequest;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    // $table->string('supplier_code', 50)->unique();
    //         $table->string('name', 150)->unique();
    //         $table->unsignedBigInteger('supplier_type_id');
    //         $table->string('contact_person', 100)->nullable();
    //         $table->string('email', 100)->nullable();
    //         $table->string('phone', 30)->nullable();
    //         $table->string('mobile', 30)->nullable();
    //         $table->string('address_line_1');
    //         $table->string('address_line_2')->nullable();
    //         $table->string('city', 100)->nullable();
    //         $table->string('state', 100)->nullable();
    //         $table->string('zip_code', 20)->nullable();
    //         $table->string('country', 100)->nullable();
    //         $table->string('tax_id', 50)->nullable();
    //         $table->string('trade_license', 100)->nullable();
    //         $table->string('bank_account', 100)->nullable();
    //         $table->string('bank_name', 100)->nullable();
    //         $table->string('swift_code', 50)->nullable();
    //         $table->boolean('is_active')->default(true);
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $supplierTypes = SupplierType::all();
        return view('inventory::setup.suppliers.index', compact('suppliers', 'supplierTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierTypes = SupplierType::all();
        return view('inventory::setup.suppliers.create', compact('supplierTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'SC';
            $length = 4;
            $lastSerial = DB::table('inventory_setup_suppliers')
                ->where('supplier_code', 'like', $prefix . '%')
                ->orderBy('supplier_code', 'desc')
                ->value('supplier_code');
            $lastNumber = (int) substr($lastSerial, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
                $supplier = Supplier::create([
                'supplier_code' => $prefix . $newNumber,
                'name' => $request->name,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'supplier_type_id' => $request->supplier_type_id,
                'contact_person' => $request->contact_person,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'website' => $request->website,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.suppliers.index')->with('success', 'Supplier created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create supplier: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('inventory::setup.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplierTypes = SupplierType::all();
        return view('inventory::setup.suppliers.edit', compact('supplier', 'supplierTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->update($request->validated());
            DB::commit();
            return redirect()->route('inventory.setup.suppliers.index')->with('success', 'Supplier updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update supplier: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            DB::commit();
            return redirect()->route('inventory.setup.suppliers.index')->with('success', 'Supplier deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete supplier: ' . $e->getMessage());
        }
    }
}
