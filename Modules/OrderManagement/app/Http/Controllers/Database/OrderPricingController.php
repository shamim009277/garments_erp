<?php

namespace Modules\OrderManagement\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Database\OrderPricing;
use Modules\OrderManagement\Models\Database\OrderPricingAccessory;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\OrderManagement\Models\Setup\BrandCategory;
use Modules\OrderManagement\Models\Setup\OrderType;
use Modules\OrderManagement\Models\Setup\YarnCount;
use Modules\OrderManagement\Models\Setup\ProductCategory;
use Modules\OrderManagement\Models\Setup\PartName;
use Modules\OrderManagement\Models\Setup\CostingHead;
use Modules\OrderManagement\Models\Setup\Accessories;
use Modules\OrderManagement\Models\Database\OrderPricingMeasurement;
use Modules\OrderManagement\Models\Database\OrderPricingFabricsCost;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\OrderManagement\Http\Requests\Database\InitialOrderRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderPricingController extends Controller
{
    use ToggleStatus;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = InitialOrder::with(['buyer', 'organization', 'color', 'size', 'orderType', 'merchant', 'yarnCount', 'productCategory', 'pricing', 'pricing.accessories.accessory', 'pricing.measurements.partName', 'pricing.fabricsCosts.costingHead'])->get();
        $order = $orders->first();
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $colors = Color::all();
        $sizes = Size::all();
        $orderTypes = OrderType::all();
        $merchants = Employee::all();
        $yarnCounts = YarnCount::all();
        $productCategories = ProductCategory::all();
        $brandCategories = BrandCategory::all();
        $partNames = PartName::where('is_active', 1)->get();
        $costingHeads = CostingHead::where('is_active', 1)->get();
        $accessories = Accessories::where('is_active', 1)->get();

        
        return view('ordermanagement::database.orderpricing.index', compact('orders', 'order', 'buyers', 'organizations', 'colors', 'sizes', 'orderTypes', 'merchants', 'yarnCounts', 'productCategories', 'brandCategories', 'partNames', 'costingHeads', 'accessories')); 
    }

    public function storeMeasurement(Request $request)
    {
        $request->validate([
            'order_pricing_id' => 'required|exists:om_database_order_pricing,id',
            'part_name_id' => 'required|exists:om_setup_part_name,id',
            'value' => 'required',
        ]);

        try {
            $measurement = OrderPricingMeasurement::create([
                'order_pricing_id' => $request->order_pricing_id,
                'part_name_id' => $request->part_name_id,
                'value' => $request->value,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Measurement added successfully',
                'measurement' => $measurement->load('partName')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteMeasurement($id)
    {
        try {
            $measurement = OrderPricingMeasurement::findOrFail($id);
            $measurement->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Measurement deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeFabricsCost(Request $request)
    {
        $request->validate([
            'order_pricing_id' => 'required|exists:om_database_order_pricing,id',
            'costing_head_id' => 'required|exists:om_setup_costing_head,id',
            'value' => 'required',
        ]);

        try {
            $fabricsCost = OrderPricingFabricsCost::create([
                'order_pricing_id' => $request->order_pricing_id,
                'costing_head_id' => $request->costing_head_id,
                'value' => $request->value,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Fabrics Cost added successfully',
                'fabricsCost' => $fabricsCost->load('costingHead')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteFabricsCost($id)
    {
        try {
            $fabricsCost = OrderPricingFabricsCost::findOrFail($id);
            $fabricsCost->delete();
            return response()->json(['status' => 'success', 'message' => 'Fabrics Cost deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function storeAccessory(Request $request)
    {
        $request->validate([
            'order_pricing_id' => 'required|exists:om_database_order_pricing,id',
            'accessory_id' => 'required|exists:om_setup_accessories,id',
            'value' => 'required|numeric',
        ]);

        try {
            $accessory = Accessories::find($request->accessory_id);

            $pricingAccessory = OrderPricingAccessory::create([
                'order_pricing_id' => $request->order_pricing_id,
                'accessory_id' => $request->accessory_id,
                'value' => $request->value,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Accessory added successfully',
                'accessory' => $pricingAccessory->load('accessory')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAccessory($id)
    {
        try {
            $accessory = OrderPricingAccessory::findOrFail($id);
            $accessory->delete();
            return response()->json(['status' => 'success', 'message' => 'Accessory deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used for now, as we create pricing via update on existing order
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not used, using update
        if($request->form_numer == 0) {
            DB::beginTransaction();
        try {
            $orderPricingEx = OrderPricing::where('order_code', $request->order_code)->exists();
            if(!$orderPricingEx) {
                $pricing = new OrderPricing();
            }else{
            $orderPricing = OrderPricing::where('order_code', $request->order_code)->first();

                $pricing = $orderPricing;
            }
            $data = $request->only(['initial_order_id',
                                    'order_code',
                                    'buyer_id',
                                    'organization_id',
                                    'order_quantity',
                                    'brand_category_id',
                                    'gsm',
                                    'seasson',
                                    'style',
                                    'fabrication',
                                    'has_embroidery',
                                    'has_print',
                                    'has_patches',
                                    'no_of_mc_req',
                                    'avg_productivity',
                                    'price_per_pcs',
                                    'cad_consumption_kg_dzn',
                                    'knitting_dyeing_allowance_percent',
                                    'cutting_wastage_allowance_percent',
                                    'dollar_conversion_rate']);

                        

            if($request->file('file')){
                @unlink($pricing->file);
                $imageName = 'orderpricing'.time().'-'.mt_rand().'.'.$request->file->extension();
                $fileName = 'frontend/uploads/images/orderpricings/'.$imageName;
                $request->file->move(public_path('frontend/uploads/images/orderpricings/'), $imageName);
                $data['file'] = $fileName;
            }
            // return $data;


             if(!$orderPricingEx) {
                $pricing->fill($data);
                $pricing->save();
            }else{
                $pricing->update($data);
            }
            

            // return $pricing;
            DB::commit();
            return redirect()->route('ordermanagement.database.orderpricings.index')->with('success', 'Initial Order pricing updated successfully');



        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        } else {
            return redirect()->back()->withErrors('Order not found');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $check = OrderPricing::where('initial_order_id', $id)->exists();
        $orders = InitialOrder::with(['buyer', 'organization', 'color', 'size', 'orderType', 'merchant', 'yarnCount', 'productCategory', 'pricing', 'pricing.accessories.accessory', 'pricing.measurements.partName', 'pricing.fabricsCosts.costingHead'])->get();

        if(!$check) {
            $order = collect($orders)->firstWhere('id', $id);
        }else{
            $order = OrderPricing::with(['buyer', 'organization', 'brandCategory', 'accessories.accessory', 'measurements.partName', 'fabricsCosts.costingHead'])->where('initial_order_id', $id)->first();
            // return $order;

        }
       
        if(!$order) {
            return redirect()->back()->withErrors('Order not found');
        }
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $colors = Color::all();
        $sizes = Size::all();
        $orderTypes = OrderType::all();
        $merchants = Employee::all();
        $yarnCounts = YarnCount::all();
        $productCategories = ProductCategory::all();
        $brandCategories = BrandCategory::all();
        $partNames = PartName::where('is_active', 1)->get();
        $costingHeads = CostingHead::where('is_active', 1)->get();
        $accessories = Accessories::where('is_active', 1)->get();

        // return $order;

        return view('ordermanagement::database.orderpricing.show', compact('orders', 'order', 'buyers', 'organizations', 'colors', 'sizes', 'orderTypes', 'merchants', 'yarnCounts', 'productCategories', 'brandCategories','check', 'partNames', 'costingHeads', 'accessories')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Maps to show/index
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $id is initial_order_id
        DB::beginTransaction();
        try {
            // Update or Create OrderPricing
            $pricingData = $request->except(['_token', '_method', 'accessories']);
            
            // Handle checkboxes/enums
            $pricingData['has_embroidery'] = $request->has('has_embroidery') && $request->has_embroidery == 'Y' ? 'Y' : 'N';
            $pricingData['has_print'] = $request->has('has_print') && $request->has_print == 'Y' ? 'Y' : 'N';
            $pricingData['has_patches'] = $request->has('has_patches') && $request->has_patches == 'Y' ? 'Y' : 'N';

            $pricing = OrderPricing::updateOrCreate(
                ['initial_order_id' => $id],
                $pricingData
            );

            // Handle Accessories
            if ($request->has('accessories')) {
                // Delete existing accessories
                $pricing->accessories()->delete();

                foreach ($request->accessories as $accessoryData) {
                    // Only create if item_name is provided
                    if (!empty($accessoryData['item_name'])) {
                        $pricing->accessories()->create([
                            'item_name' => $accessoryData['item_name'],
                            'uom' => $accessoryData['uom'] ?? null,
                            'consumption' => $accessoryData['consumption'] ?? 0,
                            'wastage_percent' => $accessoryData['wastage_percent'] ?? 0,
                            'price' => $accessoryData['price'] ?? 0,
                            'cost_per_dzn' => $accessoryData['cost_per_dzn'] ?? 0,
                        ]);
                    }
                }
            }
            
            DB::commit();
            return redirect()->route('ordermanagement.database.orderpricing.show', $id)->with('success', 'Order Pricing updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update order pricing: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function pdfData($id){
        // Existing PDF logic if needed
        return redirect()->back();
    }
}
