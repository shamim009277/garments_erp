<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;
use Modules\Inventory\Models\Database\PurRequisitionMain;
use Modules\Inventory\Models\Database\PurRequisitionDetail;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\Setup\Item;
use App\Models\Master\Setup\Unit;

class ReadyToPurChaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $store_locations = StoreLocation::all();
        $purrequisitions = PurRequisitionMain::where('is_fapproved',0)->orderBy('id', 'desc')->get();
        $items = Item::where('is_active',1)->get();
        $today_date = date('Y-m-d');
        return view('inventory::database.readytopurchase.index', compact('today_date','store_locations','purrequisitions','items'));
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
}
