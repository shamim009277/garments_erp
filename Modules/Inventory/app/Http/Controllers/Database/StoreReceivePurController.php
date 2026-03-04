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
use Illuminate\Support\Facades\DB;

class StoreReceivePurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::all();
        $store_locations = StoreLocation::all();
        $purrequisitions = PurRequisitionMain::where('is_done',0)->orderBy('id', 'desc')->get();
        $gatepurmrrs = GatePurMrrMain::where('is_store_rcv',0)->where('is_qa_checked',1)->orderBy('id', 'desc')->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        $users = User::all();
        $suppliers = Supplier::all();
        return view('inventory::database.reqstorercv.index', compact('today_date','organizations','store_locations','purrequisitions','gatepurmrrs','items','users','suppliers'));
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
    public function update(Request $request, $id) {
        $data = $request->all();
        $mrrdetail = GatePurMrrDetails::find($id);
        $mrrmain = GatePurMrrMain::where('id', $mrrdetail->mrr_id)->first();
        $detail = PurRequisitionDetail::where('id', $mrrdetail->req_detail_id)->first();
       
        if($mrrdetail->received_qty < number_format($data['store_rcv_qty'], 2, '.', '')){
            return response()->json([
                'success' => false,
                'message' => 'Received quantity is Greater than Gate Receiving quantity',
            ]);
        }
       
        $old_rcv_qty = $mrrdetail->store_rcv_qty ?? 0;
        $amount = number_format($data['store_rcv_qty'] * $data['pur_price'], 2, '.', '');
        $req_rcv_qty = $detail->rcv_store_qty ?? 0;
        $req_store_qty = $req_rcv_qty - $old_rcv_qty + number_format($data['store_rcv_qty'], 2, '.', '');
    //    $item = Item::where('id', $detail->item_id)->first();
    //    $item->update([
    //        'present_stock' => $item->present_stock + $req_store_qty,
    //    ]);
        DB::beginTransaction();
        try {
            $mrrdetail->update([
                'store_rcv_qty' => $data['store_rcv_qty'],
                'pur_price' => $data['pur_price'],
                'pur_amount' => $amount,
            ]);
           
            $detail->update([
                'is_rcv_store' => 1,
                'rcv_store_qty' => $req_store_qty,
            ]);
            $reqMain = PurRequisitionMain::where('id', $detail->pur_req_id)->first();
            
            $reqMain->update([
                'is_store_rcv' => 1,
            ]);
            $mrrmain->update([
                'bill_amount' => $mrrmain->bill_amount + $amount,
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Store Receiving successfully',
            ]); 
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    public function search(Request $request) {
        $search = $request->search;
        $match = $request->match;
        if($match == 3) {
            $gatepurmrrs = GatePurMrrMain::where('mrr_no', 'like', '%'.$search.'%')->orderBy('id', 'desc')->take(10)->get();
        } else if($match == 2) {
            $gatepurmrrs = GatePurMrrMain::where('mrr_no', 'like', '%'.$search.'%')->where('is_done', 1)->where('is_qa_checked', 1)->where('is_store_rcv', 1)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $gatepurmrrs = GatePurMrrMain::where('mrr_no', 'like', '%'.$search.'%')->where('is_done', 1)->where('is_qa_checked', 1)->where('is_store_rcv', 0)->orderBy('id', 'desc')->take(50)->get();
        }else{
            $gatepurmrrs = [];
        }
        return response()->json($gatepurmrrs);
    }
}