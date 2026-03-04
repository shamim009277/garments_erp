<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Database\GatePurMrrMain;
use Modules\Inventory\Models\Database\GatePurMrrDetails;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;
use App\Models\User;
use Modules\Inventory\Http\Requests\Database\GatePurMrrMainRequest;
use DB;
use Modules\Inventory\Models\Setup\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GatePurMrrMainController extends Controller
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
    public function store(GatePurMrrMainRequest $request) {

        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        // return $yr;
        $lastid = GatePurMrrMain::orderBy('id','DESC')->where('year','=',$year)->pluck('mrr_no')->first(); 
        if(!empty($lastid)){
            $lastid = substr($lastid,6,12)+1;                   
        }else{
            $lastid = 1;
        }
        $mrrNo = 'MRR'.$yr.str_pad($lastid, 6, "0", STR_PAD_LEFT);
        $data['mrr_no'] = $mrrNo;
        $data['year'] = $year;
        $data['month'] = $mn;
        if($request->file('document')){
            $imageName = 'gatepurmrr'.time().'-'.mt_rand().'.'.$request->document->extension();
            $fileName = 'frontend/uploads/images/gatepurmrr/'.$imageName;
            $request->document->move(public_path('frontend/uploads/images/gatepurmrr/'), $imageName);
            $data['document'] = $fileName;
        }
        DB::beginTransaction();
        try {
            $item = GatePurMrrMain::create($data);
            DB::commit();
            $item->load('organization', 'gate_entry', 'received_by', 'supplier');
            return response()->json(['success' => true, 'message' => 'Purchase Requisition created successfully', 'data' => $item]);
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
        $reqMain = GatePurMrrMain::with('organization', 'gate_entry', 'received_by', 'supplier')->find($id);
        $reqDetails = GatePurMrrDetails::with('item','req_unit','req_main')->where('mrr_id', $id)->get();
        $reqMain->document = url($reqMain->document);
        return response()->json(['reqMain'=>$reqMain,'reqDetails'=>$reqDetails]);
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
    public function update(GatePurMrrMainRequest $request, $id) {

        $data = $request->validated();
        $item = GatePurMrrMain::find($id);
        $mrrMain = GatePurMrrMain::where('id', $id)->first();
        if($mrrMain->is_done == 1){
            return response()->json([
                'success' => false,
                'message' => 'Purchase MRR is already done',
            ]);
        }
        DB::beginTransaction();
        try {
            $item->update($data);
            DB::commit();
            $item->load('organization', 'gate_entry', 'received_by', 'supplier');
            return response()->json(['success' => true, 'message' => 'Purchase MRR updated successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Purchase MRR: ' . $e->getMessage()]);
        }
    }


    public function updateDocument(Request $request, $id) {
        $item = GatePurMrrMain::find($id);
        if($request->file('document')){
            @unlink($item->document);
            $imageName = 'gatepurmrr'.time().'-'.mt_rand().'.'.$request->document->extension();
            $fileName = 'gatepurmrr/'.$imageName;
            $request->document->move(public_path('gatepurmrr/'), $imageName);
            $item->document = $fileName;
            $item->save();
        }
        return response()->json(['success' => true, 'message' => $item]);
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
            $gatepurmrrs = GatePurMrrMain::where('mrr_no', 'like', '%'.$search.'%')->where('is_done', 1)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $gatepurmrrs = GatePurMrrMain::where('mrr_no', 'like', '%'.$search.'%')->where('is_done', 0)->orderBy('id', 'desc')->take(50)->get();
        }else{
            $gatepurmrrs = [];
        }
        return response()->json($gatepurmrrs);
    }


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try {
            $item = GatePurMrrMain::find($id);
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Purchase MRR updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Purchase MRR: ' . $e->getMessage()]);
        }
    }
}
