<?php

namespace Modules\SM\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Database\SampleOrderProgramme;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\SampleType;
use Modules\OrderManagement\Models\Setup\Composition;
use Modules\OrderManagement\Models\Setup\Item;
use Modules\OrderManagement\Models\Setup\FabricTreatments;
use Modules\OrderManagement\Models\Setup\FabricSource;
use Modules\OrderManagement\Models\Setup\WashType;
use Modules\OrderManagement\Models\Setup\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Models\Setup\ProductCategory;
use Modules\SM\Models\Database\SampleOrderProduction;

use Modules\OrderManagement\Models\Setup\Buyer;

class SampleOrderProductionController extends Controller
{
    public function index()
    {
        $samples = SampleOrderProgramme::where('accept_status',1)->with('initialOrder')->get();
        $buyers = collect($samples->pluck('initialOrder.buyer'));
        $sampleTypes = SampleType::all();
        // return $buyers;
        return view('sm::database.sampleorderproduction.index', compact('buyers','sampleTypes'));
    }

    public function getOrders($buyerId)
    {
        $orders = InitialOrder::join('om_database_sample_order_programme', 'om_database_initial_order.id', '=', 'om_database_sample_order_programme.initial_order_id')
            ->where('buyer_id', $buyerId)
            ->orderBy('id', 'desc')
            ->distinct('order_code')
            ->get(['om_database_initial_order.id', 'order_code']);
        return response()->json($orders);
    }

    public function getColors($orderId)
    {
        $samples = SampleOrderProgramme::where('initial_order_id', $orderId)
            ->with(['colors']) // Load production to show existing values if any
            ->get();
        $colors = $samples->pluck('colors')->flatten()->unique('id');
        return response()->json($colors);
      
    }

   

    public function show($id)
    {
        $orders = InitialOrder::with(['organization'])->orderBy('id', 'desc')->get();
        $order = InitialOrder::with(['organization', 'buyer', 'orderType', 'merchant', 'yarnCount', 'productCategory', 'colors', 'sizes'])->findOrFail($id);
        
        // Fetch existing samples for this order
        $samples = SampleOrderProgramme::where('initial_order_id', $id)->where('accept_status', 1)
            ->with(['color', 'sampleType', 'composition', 'item', 'fabricTreatment', 'size', 'production'])
            ->get();

        $sampleColors = DB::table('om_database_initial_order_colors')
            ->where('initial_order_id', $id)
            ->pluck('color_id')
            ->toArray();
        $sampleSizes = DB::table('om_database_initial_order_sizes')
            ->where('initial_order_id', $id)
            ->pluck('size_id')
            ->toArray();
        $colors = Color::where('is_active', 1)->whereIn('id', $sampleColors)->get();
        $sampleTypes = SampleType::where('is_active', 1)->get();
        $compositions = Composition::where('is_active', 1)->get();
        $items = ProductCategory::where('is_active', 1)->get();
        $fabricTreatments = FabricTreatments::where('is_active', 1)->get();
        $sizes = Size::where('is_active', 1)->whereIn('id', $sampleSizes)->get();
        $fabricSources = FabricSource::where('is_active', 1)->get();
        $washTypes = WashType::where('is_active', 1)->get();

        return view('sm::database.sampleorderproduction.show', compact('orders', 'order', 'samples', 'colors', 'sampleTypes', 'compositions', 'items', 'fabricTreatments', 'sizes', 'fabricSources', 'washTypes'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'production_quantity' => 'required|numeric',
            'used_fabric_quantity' => 'required|numeric',
            'production_notes' => 'nullable|string',
            'current_status' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            SampleOrderProduction::updateOrCreate(
                [
                    'order_id' => $request->order_id,
                    'buyer_id' => $request->buyer_id,
                    'color_id' => $request->color_id,
                    'sample_type_id' => $request->sample_type_id,
                    'production_quantity' => $request->production_quantity,
                    'used_fabric_quantity' => $request->used_fabric_quantity,
                    'production_notes' => $request->production_notes,
                ]
            );

            
            DB::commit();

            return redirect()->back()->with('success', 'Production Information updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        // Not used for now as we use store with updateOrCreate
    }

    public function destroy($id)
    {
        try {
            $sample = SampleOrderProgramme::findOrFail($id);
            $sample->delete();
            return redirect()->back()->with('success', 'Sample Order Programme deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
