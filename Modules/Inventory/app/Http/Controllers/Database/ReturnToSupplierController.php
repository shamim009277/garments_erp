<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Setup\ChallanPurpose;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\ReturnToSupplierMain;
use Modules\Inventory\Models\Setup\Supplier;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;


class ReturnToSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::where('is_active',1)->get();
        $store_locations = StoreLocation::where('is_active',1)->get();
        $purrequisitions = PurRequisitionMain::where('is_done',0)->orderBy('id', 'desc')->take(50)->get();
        $gateoutchallans = ReturnToSupplierMain::where('is_done',0)->orderBy('id', 'desc')->take(50)->get();
        $challanpurposes = ChallanPurpose::where('is_active',1)->get();
        $suppliers = Supplier::where('is_active',1)->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        return view('inventory::database.returntosup.index', compact('today_date','organizations','store_locations','purrequisitions','items','challanpurposes','gateoutchallans','suppliers'));
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
    public function store(Request $request) {}

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
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    public function search(Request $request)
    {
        $search = $request->search;
        $type = $request->type;
        // $match = $request->match;
        if($type == 'search'){
            $purrequisitions = Item::where('item_name', 'like', '%'.$search.'%')->get();
            return response()->json($purrequisitions);
        }else if($type == 'details'){
            $item = Item::where('id', $search)->with('unit')->first();
            $unit = Unit::where('id', $item->unit_id)->first();
            $unit_standards = $unit->unit_standards;
            $units = Unit::where('unit_standards', $unit_standards)->get();
            return response()->json(['details'=>$item,'units'=>$units]);
        }
        
    }


    

}
