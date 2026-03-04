<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Database\GatePurMrrDetailsRequest;
use Modules\Inventory\Models\Database\GatePurMrrDetails;
use Modules\Inventory\Models\Database\GatePurMrrMain;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Modules\Inventory\Models\Setup\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GatePurMrrDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory::index');
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
    public function store(GatePurMrrDetailsRequest $request) {
        $data = $request->validated();
        $mrrMain = GatePurMrrMain::where('id', $data['mrr_id'])->first();
        if($mrrMain->is_done == 1){
            return response()->json([
                'success' => false,
                'message' => 'Purchase MRR is already done',
            ]);
        }
        $detail = PurRequisitionDetail::where('id', $data['req_detail_id'])->first();
        $rcv_qty = number_format((float)$data['received_qty'], 2, '.', '');
        $remained_qty = $detail->remain_qty ?? $detail->final_app_qty;
        if($remained_qty < $rcv_qty){
            return response()->json([
                'success' => false,
                'message' => 'Received quantity is Greater than Remaining quantity',
            ]);
        }
        $remain_qty = number_format($remained_qty - $rcv_qty, 2, '.', '');
        if ($remain_qty == 0) {
            $pur_stage = 2;
        }else{
            $pur_stage = 1;
        }

        $data['req_unit_id'] = $detail->pur_unit_id;
        $data['req_qty'] = $detail->for_qty;
        $data['req_price'] = $detail->aprx_priced;
        DB::beginTransaction();
        try {
            $mrrdetail = GatePurMrrDetails::create($data);
            $mrrdetail->load('item','req_unit','req_main');
            $detail->update([
                'rcv_gate_qty' => number_format($detail->rcv_gate_qty + $rcv_qty, 2, '.', ''),
                'is_pur' => 1,
                'is_rcv_gate' => 1,
                'pur_stage' => $pur_stage,
                'remain_qty' => $remain_qty,
            ]);
            $checkRest = PurRequisitionDetail::where('pur_req_id', $data['req_main_id'])->where('remain_qty','>' , 0)->exists();
            $reqMain = PurRequisitionMain::where('id', $data['req_main_id'])->first();
            if (!$checkRest) {
                $purchase_stage = 2;
            }else{
                $purchase_stage = 1;
            }
            $reqMain->update([
                'purchase_stage' => $purchase_stage,
                'is_rcv_gate' => 1,
                'is_purchased' => 1,
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $mrrdetail,
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
    public function update(Request $request, $id) {
        $data = $request->all();
        $mrrdetail = GatePurMrrDetails::find($id);
        $detail = PurRequisitionDetail::where('id', $mrrdetail->req_detail_id)->first();
        $old_rcv_qty = number_format($mrrdetail->received_qty, 2, '.', '');
        
        $updateRemain = number_format(($detail->remain_qty ?? $detail->final_app_qty) + $old_rcv_qty, 2, '.', '');
        $rcv_qty = number_format((float)$data['received_qty'], 2, '.', '');
        // return $updateRemain;
        if($rcv_qty < 0){
            return response()->json([
                'success' => false,
                'message' => 'Received quantity Must be greater than 0',
            ]);
        }
        if($updateRemain < $rcv_qty){
            return response()->json([
                'success' => false,
                'message' => 'Received quantity is Greater than Remaining quantity',
            ]);
        }
        $remain_qty = number_format(($updateRemain - $rcv_qty), 2, '.', '');
        if ($remain_qty == 0) {
            $pur_stage = 2;
        }else{
            $pur_stage = 1;
        }

       
        DB::beginTransaction();
        try {
            $mrrdetail->update([
                'received_qty' => $rcv_qty,
            ]);
            $mrrdetail->load('item','req_unit','req_main');
            $detail->update([
                'rcv_gate_qty' => number_format(($detail->rcv_gate_qty - $old_rcv_qty)+$rcv_qty, 2, '.', ''),
                'is_pur' => 1,
                'is_rcv_gate' => 1,
                'pur_stage' => $pur_stage,
                'remain_qty' => $remain_qty,
            ]);
            $checkRest = PurRequisitionDetail::where('pur_req_id', $mrrdetail->req_main_id)->where('remain_qty','>' , 0)->exists();
            $reqMain = PurRequisitionMain::where('id', $mrrdetail->req_main_id)->first();
            if (!$checkRest) {
                $purchase_stage = 2;
            }else{
                $purchase_stage = 1;
            }
            $reqMain->update([
                'purchase_stage' => $purchase_stage,
                'is_rcv_gate' => 1,
                'is_purchased' => 1,
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $mrrdetail,
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
    public function destroy($id) {

        $mrrdetail = GatePurMrrDetails::find($id);
        $detail = PurRequisitionDetail::where('id', $mrrdetail->req_detail_id)->first();
        $old_rcv_qty = number_format($mrrdetail->received_qty, 2, '.', '');
        
        
        $updateRemain = number_format($detail->remain_qty + $old_rcv_qty, 2, '.', '');
        $pur_stage = 1;

       
        DB::beginTransaction();
        try {
            $mrrdetail->delete();
            $detail->update([
                'rcv_gate_qty' => number_format(($detail->rcv_gate_qty - $old_rcv_qty), 2, '.', ''),
                'is_pur' => 1,
                'is_rcv_gate' => 1,
                'pur_stage' => $pur_stage,
                'remain_qty' => $updateRemain,
            ]);
            $checkRest = PurRequisitionDetail::where('pur_req_id', $mrrdetail->req_main_id)->where('remain_qty','>' , 0)->exists();
            $reqMain = PurRequisitionMain::where('id', $mrrdetail->req_main_id)->first();
            if (!$checkRest) {
                $purchase_stage = 2;
            }else{
                $purchase_stage = 1;
            }
            $reqMain->update([
                'purchase_stage' => $purchase_stage,
                'is_rcv_gate' => 1,
                'is_purchased' => 1,
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
            ]); 
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
