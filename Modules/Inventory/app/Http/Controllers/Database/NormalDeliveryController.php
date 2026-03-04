<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Inventory\Models\Database\NormalDeliveryMain;
use Modules\Inventory\Models\Database\NormalDeliveryDetail;
use App\Models\User;



class NormalDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::where('is_active',1)->get();
        $store_locations = StoreLocation::where('is_active',1)->get();
        $purrequisitions = NormalDeliveryMain::where('is_done',0)->orderBy('id', 'desc')->take(50)->get();
        $items = Item::where('is_active',1)->get();
        $users = User::all();
        $today_date = date('Y-m-d');
        return view('inventory::database.normaldelivery.index', compact('today_date','organizations','store_locations','purrequisitions','items','users'));
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


    public function search(Request $request)
    {
        $search = $request->search;
        $type = $request->type;
        // $match = $request->match;
        if($type == 'search'){
            $purrequisitions = Item::where('item_name', 'like', '%'.$search.'%')->get();
            return response()->json($purrequisitions);
        }else if($type == 'details'){
            $item = Item::where('id', $search)->with('unit')->first();
            $unit = Unit::where('id', $item->unit_id)->first();
            $unit_standards = $unit->unit_standards;
            $units = Unit::where('unit_standards', $unit_standards)->get();
            return response()->json(['details'=>$item,'units'=>$units]);
        }
        
    }

    public function pdfData($id){

        date_default_timezone_set('Asia/Dhaka');

        $purrequisition = NormalDeliveryMain::with('organization', 'required_by', 'store')->find($id);
        $reqDetails = NormalDeliveryDetail::with('item','pur_unit')->where('pur_req_id', $id)->get();
        $title = 'Purchase Requisition';
        $pdf = Pdf::loadView('inventory::database.purrequisition.pdf', compact('purrequisition','reqDetails','title'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('purrequisition.pdf');
    }
}
