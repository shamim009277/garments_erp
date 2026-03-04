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
use Modules\Inventory\Models\Setup\ForwardApprovePannel;
class ReqAccClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeID = Auth::user()->employee_id;
        $forapppannels = ForwardApprovePannel::where('employee_id', $employeeID)->where('is_active',1)->where('access_level',4)->pluck('organization_id')->toArray();
        $organizations = Organization::all();
        $store_locations = StoreLocation::all();
        $purrequisitions = PurRequisitionMain::where('is_done',1)->where('is_forward',1)->where('is_priced',1)->where('is_confirmed',1)->where('is_approved',0)->whereIn('organization_id', $forapppannels)->orderBy('id', 'desc')->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        return view('inventory::database.reqaccclearance.index', compact('today_date','organizations','store_locations','purrequisitions','items'));
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


    public function multipleStatus(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        $employeeID = Auth::user()->id;
        $today_date = date('Y-m-d');
        DB::beginTransaction();
        try {
            $item = PurRequisitionMain::find($id);
            $data['approved_date'] = $today_date;
            $data['approved_by_id'] = $employeeID;
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
        $match = $request->match;
        $employeeID = Auth::user()->employee_id;
        $forapppannels = ForwardApprovePannel::where('employee_id', $employeeID)->where('is_active',1)->where('access_level',4)->pluck('organization_id')->toArray();
        if($match == 3) {
            $purrequisitions = PurRequisitionMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_done',1)->where('is_forward',1)->where('is_priced',1)->where('is_confirmed',1)->whereIn('organization_id', $forapppannels)->orderBy('id', 'desc')->take(10)->get();
        } else if($match == 2) {
            $purrequisitions = PurRequisitionMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_done',1)->where('is_forward',1)->where('is_priced',1)->where('is_confirmed',1)->where('is_approved',1)->whereIn('organization_id', $forapppannels)->orderBy('id', 'desc')->take(50)->get();
        } else if($match == 1) {
            $purrequisitions = PurRequisitionMain::where('requisition_no', 'like', '%'.$search.'%')->where('is_done',1)->where('is_forward',1)->where('is_priced',1)->where('is_confirmed',1)->where('is_approved',0)->whereIn('organization_id', $forapppannels)->orderBy('id', 'desc')->take(50)->get();
        }
        return response()->json($purrequisitions);
    }
}
