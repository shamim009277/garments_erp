<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Database\PurRequisitionDetailRequest;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurRequisitionDetailController extends Controller
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
    public function store(PurRequisitionDetailRequest $request) {
        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $req_id =PurRequisitionMain::where('requisition_no','=',$data['req_no'])->first(); 
        
        $data['pur_req_id'] = $req_id->id;
       
        DB::beginTransaction();
        try {
            $reqdetail = PurRequisitionDetail::create($data);
            DB::commit();
            $reqdetail->load('item','pur_unit');
            $item = Item::where('id', $reqdetail->item_id)->with('unit')->first();
            $unit = Unit::where('id', $item->unit_id)->first();
            $unit_standards = $unit->unit_standards;
            $units = Unit::where('unit_standards', $unit_standards)->get();
            return response()->json(['details'=>$reqdetail,'units'=>$units,'unit'=>$unit]);
            // return response()->json(['success' => true, 'message' => 'Purchase Requisition created successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create Purchase Requisition: ' . $e->getMessage()]);
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
        $reqdetail = PurRequisitionDetail::find($id);
        $data = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try {
            $reqdetail->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Purchase Requisition updated successfully','data'=>$reqdetail]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Purchase Requisition: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {
            $reqdetail = PurRequisitionDetail::find($id);
            $reqdetail->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Purchase Requisition deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Purchase Requisition: ' . $e->getMessage()]);
        }
    }
}
