<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Http\Requests\Database\IntReqMainControllerRequest;
use Modules\Inventory\Models\Database\IntReqMain;
use Modules\Inventory\Models\Database\IntReqDetails;
use App\Models\Master\Setup\Unit;

class IntReqMainControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory::database.purrequisition.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::database.purrequisition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntReqMainControllerRequest $request) 
    {

        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $lastid = IntReqMain::orderBy('id','DESC')->where('year','=',$year)->pluck('requisition_no')->first(); 
        if(!empty($lastid)){
            $lastid = substr($lastid,6,12)+1;                   
        }else{
            $lastid = 1;
        }
        $requisitionNo = 'IRF'.$yr.str_pad($lastid, 6, "0", STR_PAD_LEFT);
        $data['requisition_no'] = $requisitionNo;
        $data['year'] = $year;
        $data['month'] = $mn;
        DB::beginTransaction();
        try {
            $item = IntReqMain::create($data);
            DB::commit();
            $item->load('organization', 'required_by', 'store');
            return response()->json(['success' => true, 'message' => 'Internal Requisition created successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create Internal Requisition: ' . $e->getMessage()]);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $reqMain = IntReqMain::with('organization', 'required_by', 'store')->find($id);
        $reqDetails = IntReqDetails::with('item','pur_unit')->where('pur_req_id', $id)->get();
        $unit_datas = [];
        foreach($reqDetails as $reqdetail){
            $unit_datas[] = $reqdetail->item->unit->unit_standards;
        }
        $units = Unit::whereIn('unit_standards', $unit_datas)->get();
        return response()->json(['reqMain'=>$reqMain,'reqDetails'=>$reqDetails,'units'=>$units]);
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
    public function update(IntReqMainControllerRequest $request, $id) {

        $data = $request->validated();
        $item = IntReqMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Internal Requisition is already done']);
        }
        DB::beginTransaction();
        try {
            $item->update($data);
            DB::commit();
            $item->load('organization', 'required_by', 'store');
            return response()->json(['success' => true, 'message' => 'Internal Requisition updated successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Internal Requisition: ' . $e->getMessage()]);
        }
        
    }


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try {
            $item = IntReqMain::find($id);
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Internal Requisition updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Internal Requisition: ' . $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $item = IntReqMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Internal Requisition is already done']);
        }
        DB::beginTransaction();
        try {
            IntReqDetails::where('pur_req_id', $id)->delete();
            $item->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Internal Requisition deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Internal Requisition: ' . $e->getMessage()]);
        }
    }

    public function search(Request $request) {
        $search = $request->search;
        $match = $request->match;
        if($match == 3) {
            $purrequisitions = IntReqMain::where('requisition_no', 'like', '%'.$search.'%')->orderBy('id', 'desc')->take(10)->get();
        } else if($match == 2) {
            $purrequisitions = IntReqMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_done', 1)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $purrequisitions = IntReqMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_done', 0)->orderBy('id', 'desc')->take(50)->get();
        }
        return response()->json($purrequisitions);
    }
}