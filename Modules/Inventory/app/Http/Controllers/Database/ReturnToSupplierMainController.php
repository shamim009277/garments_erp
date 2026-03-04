<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Http\Requests\Database\ReturnToSupplierMainRequest;
use Modules\Inventory\Models\Database\ReturnToSupplierMain;
use Modules\Inventory\Models\Database\ReturnToSupplierDetail;
use App\Models\Master\Setup\Unit;
use Barryvdh\DomPDF\Facade\Pdf;

class ReturnToSupplierMainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory::database.gateoutchallan.index');
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
    public function store(ReturnToSupplierMainRequest $request) 
    {
        $data = $request->validated();
        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $lastid = ReturnToSupplierMain::orderBy('id','DESC')->where('year','=',$year)->pluck('challan_no')->first(); 
        if(!empty($lastid)){
            $lastid = substr($lastid,6,12)+1;                   
        }else{
            $lastid = 1;
        }
        $challanNo = 'RTS'.$yr.str_pad($lastid, 6, "0", STR_PAD_LEFT);
        $data['challan_no'] = $challanNo;
        $data['year'] = $year;
        $data['month'] = $mn;
        DB::beginTransaction();
        try {
            $item = ReturnToSupplierMain::create($data);
            DB::commit();
            $item->load('organization', 'party', 'challan_by', 'store', 'purpose');
            return response()->json(['success' => true, 'message' => 'Return to Supplier created successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create Return to Supplier: ' . $e->getMessage()]);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $challanMain = ReturnToSupplierMain::with('organization', 'party', 'challan_by', 'store', 'purpose')->find($id);
        $challanDetails = ReturnToSupplierDetail::with('item','unit')->where('challan_id', $id)->get();
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
    public function update(ReturnToSupplierMainRequest $request, $id) {

        $data = $request->validated();
        $item = ReturnToSupplierMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Return To Supplier is already done']);
        }
        DB::beginTransaction();
        try {
            $item->update($data);
            DB::commit();
            $item->load('organization', 'party', 'challan_by', 'store', 'purpose');
            return response()->json(['success' => true, 'message' => 'Return To Supplier updated successfully', 'data' => $item]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Return To Supplier: ' . $e->getMessage()]);
        }
        
    }


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        // return $data;
        DB::beginTransaction();
        try {
            $item = ReturnToSupplierMain::find($id);
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Return To Supplier updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Return To Supplier: ' . $e->getMessage()]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $item = ReturnToSupplierMain::find($id);
        if($item->is_done == 1){
            return response()->json(['success' => false, 'message' => 'Return To Supplier is already done']);
        }
        DB::beginTransaction();
        try {
            ReturnToSupplierDetail::where('challan_id', $id)->delete();
            $item->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Return To Supplier deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Return To Supplier: ' . $e->getMessage()]);
        }
    }

    public function search(Request $request) {
        $search = $request->search;
        $match = $request->match;
        if($match == 3) {
            $purrequisitions = ReturnToSupplierMain::where('challan_no', 'like', '%'.$search.'%')->orderBy('id', 'desc')->take(10)->get();
        } else if($match == 2) {
            $purrequisitions = ReturnToSupplierMain::where('challan_no', 'like', '%'.$search.'%')->where('is_done', 1)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $purrequisitions = ReturnToSupplierMain::where('challan_no', 'like', '%'.$search.'%')->where('is_done', 0)->orderBy('id', 'desc')->take(50)->get();
        }
        return response()->json($purrequisitions);
    }




    public function pdfGatePassData($id){

        date_default_timezone_set('Asia/Dhaka');

        $challanMain = ReturnToSupplierMain::with('organization', 'party', 'challan_by', 'store', 'purpose')->find($id);
        $challanDetails = ReturnToSupplierDetail::with('item','unit')->where('challan_id', $id)->get();
        // return [$challanMain,$challanDetails];
        $title = 'Gate Pass';
        $pdf = Pdf::loadView('inventory::database.returntosup.pdf', compact('challanMain','challanDetails','title'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('gatepass.pdf');
    }

    public function pdfChallanData($id){

        date_default_timezone_set('Asia/Dhaka');

        $challanMain = ReturnToSupplierMain::with('organization', 'party', 'challan_by', 'store', 'purpose')->find($id);
        $challanDetails = ReturnToSupplierDetail::with('item','unit')->where('challan_id', $id)->get();
        // return [$challanMain,$challanDetails];
        $title = 'Gate Challan';
        $pdf = Pdf::loadView('inventory::database.returntosup.pdf', compact('challanMain','challanDetails','title'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('gatepass.pdf');
    }
}
