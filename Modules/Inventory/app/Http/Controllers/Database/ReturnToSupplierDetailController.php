<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Database\ReturnToSupplierDetailRequest;
use Modules\Inventory\Models\Database\ReturnToSupplierDetail;
use Modules\Inventory\Models\Database\ReturnToSupplierMain;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReturnToSupplierDetailController extends Controller
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
    public function store(ReturnToSupplierDetailRequest $request) {
        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $challan_id =ReturnToSupplierMain::where('challan_no','=',$data['challan_no'])->first(); 
        $item = ReturnToSupplierDetail::where('challan_id', $challan_id->id)->where('item_id', $data['item_id'])->first();
        
        if($challan_id->is_gate_out == 1){
            return response()->json(['success' => false, 'message' => 'Return To Supplier is already done']);
        }else if($item){
            return response()->json(['success' => false, 'message' => 'Item already added']);
        }
        $data['challan_id'] = $challan_id->id;
       
        DB::beginTransaction();
        try {
            $reqdetail = ReturnToSupplierDetail::create($data);
            DB::commit();
            $reqdetail->load('item','unit');
            $item = Item::where('id', $reqdetail->item_id)->with('unit')->first();
            $unit = Unit::where('id', $item->unit_id)->first();
            $unit_standards = $unit->unit_standards;
            $units = Unit::where('unit_standards', $unit_standards)->get();
            return response()->json(['success' => true, 'details'=>$reqdetail,'units'=>$units,'unit'=>$unit]);
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
        $challandetail = ReturnToSupplierDetail::find($id);
        $data = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try {
            $challandetail->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Gate Out Challan updated successfully','data'=>$challandetail]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Gate Out Challan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {
            $challandetail = ReturnToSupplierDetail::find($id);
            $challandetail->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Gate Out Challan deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Gate Out Challan: ' . $e->getMessage()]);
        }
    }
}
