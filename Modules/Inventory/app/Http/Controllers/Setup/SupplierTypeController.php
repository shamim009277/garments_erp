<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Setup\SupplierTypeRequest;
use Modules\Inventory\Models\Setup\SupplierType;
use Illuminate\Support\Facades\DB;

class SupplierTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // $table->bigIncrements('id');
    //         $table->string('type_code', 50)->unique();
    //         $table->string('name', 100);
    //         $table->text('description')->nullable();
    //         $table->boolean('is_active')->default(true);

    function __construct()
    {
        $this->middleware('permission:inventory.supplier-types.view')->only('index','show');
        $this->middleware('permission:inventory.supplier-types.add')->only('store');
        $this->middleware('permission:inventory.supplier-types.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:inventory.supplier-types.delete')->only('destroy');
    }









    public function index()
    {
        $supplierTypes = SupplierType::all();
        return view('inventory::setup.suppliertypes.index', compact('supplierTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.suppliertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierTypeRequest $request)
    {
        // dd($request->all());
        $prefix = 'SC';
        $length = 4;

        // Get last serial number with prefix
        $lastSerial = DB::table('inventory_setup_supplier_types')
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
        $supplierType = new SupplierType;
        $supplierType->type_code = $prefix . $newNumber;
        $supplierType->name = $request->name;
        $supplierType->description = $request->description;
        $supplierType->is_active = $request->is_active;
        // $supplierType->created_by = auth()->user()->id;
        // $supplierType->updated_by = auth()->user()->id
        $supplierType->save();

        // dd($supplierType);
        return redirect()->route('inventory.setup.suppliertypes.index')->with('success', 'Supplier Type Created Successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $supplierType = SupplierType::findOrFail($id);
        return view('inventory::setup.suppliertypes.show', compact('supplierType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplierType = SupplierType::findOrFail($id);
        return view('inventory::setup.suppliertypes.edit', compact('supplierType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierTypeRequest $request, $id)
    {
        $supplierType = SupplierType::findOrFail($id);
        $supplierType->update($request->validated());
        return redirect()->route('inventory.setup.suppliertypes.index')->with('success', 'Supplier Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplierType = SupplierType::findOrFail($id);
        $supplierType->delete();
        return redirect()->route('inventory.setup.suppliertypes.index')->with('success', 'Supplier Type deleted successfully');
    }
}
