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
use Modules\HRIS\Models\Database\Employee;
use Modules\Inventory\Models\Setup\ProductCategory;
use Modules\SM\Models\Database\SampleOrderProduction;
use Modules\HRIS\Models\Setup\Organization;




use Modules\OrderManagement\Models\Setup\Buyer;

class SampleOrderProductionController extends Controller
{
    public function index()
    {
        $employee_id = Auth::user();
        // $org_id = Employee::where('employee_id', Auth::user()->employee_id)->first();
        // return $employee_id;
        $samples = SampleOrderProgramme::where('accept_status',1)->with('initialOrder')->get();
        $buyers = collect($samples->pluck('initialOrder.buyer'))->unique('id');
        // return $buyers;
        return view('sm::database.sampleorderproduction.index', compact('buyers'));
    }

    public function getOrders($buyerId)
    {
        $orders = InitialOrder::join('om_database_sample_order_programme', 'om_database_initial_order.id', '=', 'om_database_sample_order_programme.initial_order_id')
            ->where('buyer_id', $buyerId)
            // ->where('om_database_initial_order.organization_id', $org_id)
            ->orderBy('id', 'desc')
            ->distinct('order_code')
            ->get(['om_database_initial_order.id', 'order_code']);
        return response()->json($orders);
    }

    public function getProgrammes($orderId)
    {
        $programme = SampleOrderProgramme::where('initial_order_id', $orderId)
            ->get();
        return response()->json($programme);
      
    }


    public function getColors($orderId)
    {
        $samples = SampleOrderProgramme::where('id', $orderId)
            ->with(['colors', 'sizes', 'sampleType']) // Load production to show existing values if any
            ->get();
        $colors = $samples->pluck('colors')->flatten()->unique('id');
        $sizes = $samples->pluck('sizes')->flatten()->unique('id');
        $sampleTypes = $samples->pluck('sampleType')->flatten()->unique('id');
        return response()->json(['colors' => $colors, 'sizes' => $sizes, 'sampleTypes' => $sampleTypes]);
      
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
                    'buyer_id' => $request->buyer_id,
                    'order_id' => $request->order_id,
                    'programme_id' => $request->programme_id,
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
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
