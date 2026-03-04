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

class SampleOrderProgrammeController extends Controller
{
    public function index()
    {
        $orders = InitialOrder::with(['organization'])->orderBy('id', 'desc')->get();
        return view('sm::database.sampleorderprogramme.index', compact('orders'));
    }

    public function show($id)
    {
        $orders = InitialOrder::with(['organization'])->orderBy('id', 'desc')->get();
        $order = InitialOrder::with(['organization', 'buyer', 'orderType', 'merchant', 'yarnCount', 'productCategory', 'colors', 'sizes'])->findOrFail($id);
        
        // Fetch existing samples for this order
        $samples = SampleOrderProgramme::where('initial_order_id', $id)
            ->with(['color', 'sampleType', 'composition', 'item', 'fabricTreatment', 'size'])
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

        return view('sm::database.sampleorderprogramme.show', compact('orders', 'order', 'samples', 'colors', 'sampleTypes', 'compositions', 'items', 'fabricTreatments', 'sizes', 'fabricSources', 'washTypes'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'initial_order_id' => 'required|exists:om_database_initial_order,id',
            'fab_src' => 'nullable|string',
            'color_id' => 'nullable|exists:inventory_setup_colors,id',
            'sample_type_id' => 'nullable|exists:om_setup_sample_types,id',
            'composition_id' => 'nullable|exists:inventory_setup_compositions,id',
            'trims_fabric' => 'nullable|string',
            'wash_type' => 'nullable|string',
            'style_no' => 'nullable|string',
            'item_id' => 'nullable|exists:inventory_setup_product_categories,id',
            'f_dia' => 'nullable|string',
            'gsm' => 'nullable|string',
            'fin_fab_kg' => 'nullable|numeric',
            'qty_pcs' => 'nullable|integer',
            'fabric_treatment_id' => 'nullable|exists:inventory_setup_fabric_treatments,id',
            'print_emb_inst' => 'nullable|string',
            'size_id' => 'nullable',
            'delivery_deadline' => 'nullable|date',
            'tri_acr' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        try {
            SampleOrderProgramme::create($request->except('_token'));
            return redirect()->back()->with('success', 'Sample Order Programme added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'fab_src' => 'nullable|string',
            'color_id' => 'nullable|exists:inventory_setup_colors,id',
            'sample_type_id' => 'nullable|exists:om_setup_sample_types,id',
            // ... add other validations
        ]);
        
        try {
            $sample = SampleOrderProgramme::findOrFail($id);
            $sample->update($request->except(['_token', '_method']));
            return redirect()->back()->with('success', 'Sample Order Programme updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
