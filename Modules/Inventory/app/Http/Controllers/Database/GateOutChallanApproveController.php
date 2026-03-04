<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Setup\ChallanPurpose;
use Modules\Inventory\Models\Database\GateOutChallanMain;
use Modules\Inventory\Models\Database\GateOutChallanDetail;
use Modules\Inventory\Models\Setup\Supplier;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

class GateOutChallanApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::where('is_active',1)->get();
        $store_locations = StoreLocation::where('is_active',1)->get();
        $gateoutchallans = GateOutChallanMain::where('is_done',1)->where('is_approved',0)->orderBy('id', 'desc')->take(50)->get();
        $challanpurposes = ChallanPurpose::where('is_active',1)->get();
        $suppliers = Supplier::where('is_active',1)->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        return view('inventory::database.gateoutchallanapprv.index', compact('today_date','organizations','store_locations','items','challanpurposes','gateoutchallans','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::database.gateoutchallan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GateOutChallanMainRequest $request) 
    {
        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $lastid = GateOutChallanMain::orderBy('id','DESC')->where('year','=',$year)->pluck('challan_no')->first(); 
        if(!empty($lastid)){
            $lastid = substr($lastid,6,12)+1;                   
        }else{
            $lastid = 1;
        }
        $challanNo = 'GOC'.$yr.str_pad($lastid, 6, "0", STR_PAD_LEFT);
        $data['challan_no'] = $challanNo;
        $data['year'] = $year;
        $data['month'] = $mn;
        DB::beginTransaction();
        try {
            $item = GateOutChallanMain::create($data);
            DB::commit();
            $item->load('organization', 'party', 'challan_by', 'store', 'purpose');
            return response()->json(['success' => true, 'message' => 'Gate Out Challan created successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create Gate Out Challan: ' . $e->getMessage()]);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $challanMain = GateOutChallanMain::with('organization', 'party', 'challan_by', 'store', 'purpose')->find($id);
        $challanDetails = GateOutChallanDetail::with('item','unit')->where('challan_id', $id)->get();
        $unit_datas = [];
        foreach($challanDetails as $challanDetail){
            $unit_datas[] = $challanDetail->item->unit->unit_standards;
        }
        $units = Unit::whereIn('unit_standards', $unit_datas)->get();
        return response()->json(['challanMain'=>$challanMain,'challanDetails'=>$challanDetails,'units'=>$units]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('inventory::database.purrequisition.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GateOutChallanMainRequest $request, $id) {

        $data = $request->validated();
        $item = GateOutChallanMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Gate Out Challan is already done']);
        }
        DB::beginTransaction();
        try {
            $item->update($data);
            DB::commit();
            $item->load('organization', 'party', 'challan_by', 'store', 'purpose');
            return response()->json(['success' => true, 'message' => 'Gate Out Challan updated successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Gate Out Challan: ' . $e->getMessage()]);
        }
        
    }


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        // return $data;
        DB::beginTransaction();
        try {
            $item = GateOutChallanMain::find($id);
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Purchase Requisition updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Purchase Requisition: ' . $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $item = GateOutChallanMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Gate Out Challan is already done']);
        }
        DB::beginTransaction();
        try {
            GateOutChallanDetail::where('challan_id', $id)->delete();
            $item->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Gate Out Challan deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Gate Out Challan: ' . $e->getMessage()]);
        }
    }

    public function search(Request $request) {
        $search = $request->search;
        $match = $request->match;
        if($match == 3) {
            $purrequisitions = GateOutChallanMain::where('challan_no', 'like', '%'.$search.'%')->where('is_done',1)->orderBy('id', 'desc')->take(10)->get();
        } else if($match == 2) {
            $purrequisitions = GateOutChallanMain::where('challan_no', 'like', '%'.$search.'%')->where('is_done',1)->where('is_approved',1)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $purrequisitions = GateOutChallanMain::where('challan_no', 'like', '%'.$search.'%')->where('is_done',1)->where('is_approved',0)->orderBy('id', 'desc')->take(50)->get();
        }
        return response()->json($purrequisitions);
    }
}
