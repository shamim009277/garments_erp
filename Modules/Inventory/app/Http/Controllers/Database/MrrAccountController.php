<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Modules\Inventory\Models\Database\GatePurMrrMain;
use Modules\Inventory\Models\Database\GatePurMrrDetails;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;
use App\Models\User;
use Modules\Inventory\Models\Setup\Supplier;

use Illuminate\Support\Facades\Auth;

class MrrAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::all();
        $store_locations = StoreLocation::all();
        $purrequisitions = PurRequisitionMain::where('is_done',0)->orderBy('id', 'desc')->get();
        $gatepurmrrs = GatePurMrrMain::where('is_audit_chck',2)->orderBy('id', 'desc')->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        $users = User::all();
        $suppliers = Supplier::all();
        return view('inventory::database.mrracc.index', compact('today_date','organizations','store_locations','purrequisitions','gatepurmrrs','items','users','suppliers'));
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

     public function reqMainsSearch(Request $request)
    {
        $mrr_id = $request->mrr_id;
        $itemExists = GatePurMrrDetails::where('mrr_id', $mrr_id)->pluck('item_id')->toArray();
        $reqMain = PurRequisitionMain::with('organization', 'required_by', 'store')->find($request->id);
        $reqDetails = PurRequisitionDetail::with('item','pur_unit')->where('pur_req_id', $request->id)->where('is_rejected', 0)->whereNotIn('item_id', $itemExists)->get();
        $unit_datas = [];
        foreach($reqDetails as $reqdetail){
            $unit_datas[] = $reqdetail->item->unit->unit_standards;
        }
        $reqMain->document = url($reqMain->document);
        $units = Unit::whereIn('unit_standards', $unit_datas)->get();
        return response()->json(['reqMain'=>$reqMain,'reqDetails'=>$reqDetails,'units'=>$units]);
    }

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


    public function search(Request $request) {
        $search = $request->search;
        $mrr_id = $request->mrr_id;
        $org_id = GatePurMrrMain::where('id', $mrr_id)->first();
        if($org_id ==null){
            return [];
        }
        $purrequisitions = PurRequisitionMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_fapproved',1)->whereIn('purchase_stage',[0,1])->where('organization_id', $org_id->organization_id)->orderBy('id', 'desc')->take(10)->get();
        return response()->json($purrequisitions);
    }
}
