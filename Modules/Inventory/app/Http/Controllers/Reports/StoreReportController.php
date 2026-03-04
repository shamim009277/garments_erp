<?php

namespace Modules\Inventory\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\StoreLocation;

use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Models\Setup\GoodsSubCategory;

class StoreReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::all();
        $store_locations = StoreLocation::all();
        $goodsCategories = GoodsCategory::pluck('name', 'id');
        $goodsSubcategories = GoodsSubCategory::pluck('name', 'id');
        return view('inventory::reports.store.index', compact('startDate', 'endDate', 'organizations', 'store_locations', 'goodsCategories', 'goodsSubcategories'));
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
