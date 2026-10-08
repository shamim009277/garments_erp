<?php

namespace Modules\Commercial\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Commercial\Models\Setup\DeliveryTerm;
use Modules\Commercial\Models\Setup\PaymentMethod;
use Modules\Commercial\Models\Setup\PaymentTerm;
use Modules\Commercial\Models\Setup\ShipmentMode;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\Buyer;

class SalesContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyerlist = Buyer::query()->pluck('buyer_name', 'id');
        $orglist = Organization::query()->active()->pluck('short_name', 'id');

        $ptarms = PaymentTerm::query()->active()->pluck('name','id');
        $pmethod = PaymentMethod::query()->active()->pluck('name','id');
        $shipmode = ShipmentMode::query()->active()->pluck('name','id');
        $deliveryterm = DeliveryTerm::query()->active()->pluck('name','id');
        
        return view('commercial::database.salescontact.index', compact('buyerlist', 'orglist','ptarms','pmethod','shipmode','deliveryterm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commercial::create');
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
        return view('commercial::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('commercial::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    /**
     * Search the specified resource.
     */
    public function getSearch(Request $request)
    {
        $search = $request->input('search');
        
        return $search;
    }
}
