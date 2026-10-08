<?php

namespace Modules\Commercial\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\Commercial\Http\Requests\Setup\ShipmentModeRequest;
use Modules\Commercial\Models\Setup\ShipmentMode;

class ShipmentModeController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipment_modes = ShipmentMode::query()->get();
        return view('commercial::setup.shipmentmode.index', compact('shipment_modes'));
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
    public function store(ShipmentModeRequest $request) {
        try {
            $request->validated();
            ShipmentMode::query()->create($request->validated());
            return redirect()->back()->withSuccess('Shipment mode created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

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
    public function update(ShipmentModeRequest $request, $id) {
        try {
            $request->validated();
            ShipmentMode::query()->find($id)->update($request->validated());
            return redirect()->back()->withSuccess('Shipment mode updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            ShipmentMode::query()->find($id)->delete();
            return redirect()->back()->withSuccess('Shipment mode deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, ShipmentMode::class);
    }
}
