<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\OrderManagement\Http\Requests\Setup\BomSetupRequest;
use Modules\OrderManagement\Models\Setup\BomSetup;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Item;
use Modules\Inventory\Models\Setup\Supplier;
use App\Models\Master\Setup\Unit;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Http\Request;

class BomSetupController extends Controller
{
    public function index()
    {
        $boms = BomSetup::with(['buyer', 'organization', 'item', 'consumptionUnit', 'unit', 'supplier'])
            ->orderBy('id', 'desc')
            ->get();
        $buyers = Buyer::where('is_active', 1)->get();
        $items = Item::where('is_active', 1)->get();
        $units = Unit::active()->get();
        $suppliers = Supplier::where('is_active', 1)->get();
        $organizations = Organization::active()->get();

        return view('ordermanagement::setup.bomsetups.index', compact('boms', 'buyers', 'items', 'units', 'suppliers', 'organizations'));
    }

    public function store(BomSetupRequest $request)
    {
        try {
            DB::beginTransaction();
            BomSetup::create($request->validated());
            DB::commit();

            return redirect()->back()->with('success', 'BOM Setup created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
            $boms = BomSetup::with(['buyer', 'organization', 'item', 'consumptionUnit', 'unit', 'supplier'])
                ->where('buyer_id', $id)
                ->orderBy('id', 'desc')
                ->get();
            $buyers = Buyer::where('is_active', 1)->get();
            $buyerId = Buyer::findOrFail($id);
            $items = Item::where('is_active', 1)->get();
            $units = Unit::active()->get();
            $suppliers = Supplier::where('is_active', 1)->get();
            $organizations = Organization::active()->get();

            return view('ordermanagement::setup.bomsetups.show', compact('boms', 'buyers', 'buyerId', 'items', 'units', 'suppliers', 'organizations'));
    }

//  public function show(Request $request, $id)
//     {
//         $bom = BomSetup::findOrFail($id);
//         return response()->json($bom);
//     }

    public function edit($id)
    {
        $bom = BomSetup::findOrFail($id);
        return response()->json($bom);
    }

    public function update(BomSetupRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $bom = BomSetup::findOrFail($id);
            $bom->update($request->validated());
            DB::commit();

            return redirect()->back()->with('success', 'BOM Setup updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $bom = BomSetup::findOrFail($id);
            $bom->delete();

            return redirect()->back()->with('success', 'BOM Setup deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
