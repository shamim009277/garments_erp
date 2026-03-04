<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

class PurReqTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeID = Auth::user()->employee_id;
        $purrequisitions = PurRequisitionMain::orderBy('id', 'desc')->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        return view('inventory::database.purreqtracking.index', compact('today_date','purrequisitions','items'));
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
        
        $reqMain = PurRequisitionMain::with('organization', 'required_by', 'store','done_by','forward_by','priced_by','confirmed_by','approved_by','rejected_by','fapproved_by')->find($id);
        // return $reqMain;
        $reqDetails = PurRequisitionDetail::with('item','pur_unit')->where('pur_req_id', $id)->get();
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


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        $employeeID = Auth::user()->id;
        $today_date = date('Y-m-d');
        DB::beginTransaction();
        try {
            $item = PurRequisitionMain::find($id);
            $data['approved_date'] = $today_date;
            $data['approved_by'] = $employeeID;
            $item->update($data);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Purchase Requisition updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update Purchase Requisition: ' . $e->getMessage()]);
        }
    }



    public function search(Request $request) {
        $search = $request->search;
        $purrequisitions = PurRequisitionMain::where('requisition_no', 'like', '%'.$search.'%')->orderBy('id', 'desc')->take(10)->get();
        return response()->json($purrequisitions);
    }
}
