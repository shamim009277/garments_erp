<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Database\BasicOrder;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\Buyer;
use Modules\Inventory\Models\Setup\ProductCategory;
use Modules\Inventory\Models\Setup\FabricType;
use Modules\Inventory\Models\Setup\Composition;
use Modules\Inventory\Models\Setup\FabricTreatments;
use Modules\Inventory\Models\Setup\YarnCount;
use Modules\Inventory\Http\Requests\Database\BasicOrderRequest;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BasicOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basicorders = BasicOrder::all();
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $product_categories = ProductCategory::all();
        $merchandisers = User::all();
        $fabric_types = FabricType::all();
        $compositions = Composition::all();
        $fabric_treatments = FabricTreatments::all();
        $yarn_counts = YarnCount::all();
        $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();
        return view('inventory::database.basicorders.index', compact('basicorders', 'organizations', 'buyers', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories'));
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
    public function store(BasicOrderRequest $request) {
        dd($request->all());
        $orderNo = 'BO' . str_pad(BasicOrder::count() + 1, 3, '0', STR_PAD_LEFT);
        $request['order_no'] = $orderNo;

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        try {
            BasicOrder::create($request->validated());
            return redirect()->route('inventory.database.basicorders.index')->with('success', 'Basic Order created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create basic order: ' . $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $basicorder = BasicOrder::findOrFail($id);
        return view('inventory::database.basicorders.show', compact('basicorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $basicorder = BasicOrder::findOrFail($id);
        return view('inventory::database.basicorders.edit', compact('basicorder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicOrderRequest $request, $id) {
        try {
            BasicOrder::findOrFail($id)->update($request->validated());
            return redirect()->route('inventory.database.basicorders.index')->with('success', 'Basic Order updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update basic order: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            BasicOrder::findOrFail($id)->delete();
            return redirect()->route('inventory.database.basicorders.index')->with('success', 'Basic Order deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete basic order: ' . $th->getMessage());
        }
    }
}
