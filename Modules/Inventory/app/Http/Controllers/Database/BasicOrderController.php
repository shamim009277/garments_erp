<?php

namespace Modules\Inventory\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Database\BasicOrder;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Inventory\Models\Setup\Buyer;
use Modules\Inventory\Models\Setup\ProductCategory;
use Modules\Inventory\Models\Setup\FabricType;
use Modules\Inventory\Models\Setup\Composition;
use Modules\Inventory\Models\Setup\FabricTreatments;
use Modules\Inventory\Models\Setup\YarnCount;
use Modules\Inventory\Models\Setup\Lot;
use Modules\Inventory\Models\Setup\Color;
use Modules\Inventory\Models\Setup\Size;
use Modules\Inventory\Http\Requests\Database\BasicOrderRequest;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BasicOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basicorders = BasicOrder::all();
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $product_categories = ProductCategory::all();
        $merchandisers = User::all();
        $fabric_types = FabricType::all();
        $compositions = Composition::all();
        $fabric_treatments = FabricTreatments::all();
        $yarn_counts = YarnCount::all();
        $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();
        //DB::enableQueryLog();
        $ListOfOrders = BasicOrder::with('buyer')->get();

        $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
        // dd($ListOfOrdersUniqueBuyer);




        return view('inventory::database.basicorders.index', compact('basicorders', 'organizations', 'buyers', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders'));
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
    public function store(BasicOrderRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            BasicOrder::create([
                'order_type' => $request->order_type,
                'compile_type' => $request->compile_type,
                'organization_id' => $request->organization_id,
                'buyer_id' => $request->buyer_id,
                'style_no' => $request->style_no,
                'style_description' => $request->style_description,
                'order_no' => $request->order_no,
                'season' => $request->season,
                'fitting_type' => $request->fitting_type,
                'product_category_id' => $request->product_category_id,
                'merchandiser_id' => $request->merchandiser_id,
                'fabric_type_id' => $request->fabric_type_id,
                'composition_id' => $request->composition_id,
                'fabric_treatment_id' => $request->fabric_treatment_id,
                'yarn_count_id' => $request->yarn_count_id,
                'yarn_category_id' => $request->yarn_category_id,
                'gsm' => $request->gsm,
                'bw_gsm' => $request->bw_gsm,
                'finished_dia' => $request->finished_dia,
                'finish_type' => $request->finish_type,
                'print_type' => $request->print_type,
                'print_price_per_dzn' => $request->print_price_per_dzn,
                'embroidery_type' => $request->embroidery_type,
                'embroidery_price_per_dzn' => $request->embroidery_price_per_dzn,
                'wash_type' => $request->wash_type,
                'garment_dye_price_per_dzn' => $request->garment_dye_price_per_dzn,
                'order_date' => $request->order_date,
                'unit_price' => $request->unit_price,
                'cm_price_per_dzn' => $request->cm_price_per_dzn,
                'order_quantity' => $request->order_quantity,
                'extra_cutting_percent' => $request->extra_cutting_percent,
                'fabric_booking_needed' => $request->fabric_booking_needed,
                'fabric_consumption_kg_dz' => $request->fabric_consumption_kg_dz,
                'kd_allowance_percent' => $request->kd_allowance_percent,
                'cutting_consumption_yards_pcs' => $request->cutting_consumption_yards_pcs,
                'booking_consumption_yards_pcs' => $request->booking_consumption_yards_pcs,
                'delivery_mode' => $request->delivery_mode,
                'delivery_date' => $request->delivery_date,
                'trims_required_approved' => $request->trims_required_approved,
                'closed' => $request->closed,
                'fabric_from_stock' => $request->fabric_from_stock,
                'style_complexity_notes' => 'N/A',
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
            DB::commit();
            return redirect()->route('inventory.database.basicorders.index')->with('success', 'Basic Order created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create basic order: ' . $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, $id)
    {

        $tab = intval($request->get('tab'));
        if ($tab == 1) {
            $basicorders = BasicOrder::all();
            $buyers = Buyer::all();
            $organizations = Organization::all();
            $product_categories = ProductCategory::all();
            $merchandisers = User::all();
            $fabric_types = FabricType::all();
            $compositions = Composition::all();
            $fabric_treatments = FabricTreatments::all();
            $yarn_counts = YarnCount::all();
            $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();

            $ListOfOrders = BasicOrder::with('buyer')->get();

            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $basicorder = BasicOrder::findOrFail($id);
            // dd($basicorder);
            return view('inventory::database.basicorders.show', compact('basicorder', 'basicorders', 'buyers', 'organizations', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'tab'));
        } elseif ($tab == 2) {
            $basicorders = BasicOrder::all();
            $buyers = Buyer::all();
            $organizations = Organization::all();
            $product_categories = ProductCategory::all();
            $merchandisers = User::all();
            $fabric_types = FabricType::all();
            $compositions = Composition::all();
            $fabric_treatments = FabricTreatments::all();
            $yarn_counts = YarnCount::all();
            $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();

            $ListOfOrders = BasicOrder::with('buyer')->get();
            $lots = DB::table('inventory_setup_order_lots')->where('order_id', $id)->get();
            $colors = Color::all();
            $sizes = Size::all();

            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $basicorder = BasicOrder::findOrFail($id);
            return view('inventory::database.basicorders.show', compact('basicorder', 'basicorders', 'buyers', 'organizations', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'tab', 'lots', 'colors', 'sizes'));
        } elseif ($tab == 3) {
            $basicorders = BasicOrder::all();
            $buyers = Buyer::all();
            $organizations = Organization::all();
            $product_categories = ProductCategory::all();
            $merchandisers = User::all();
            $fabric_types = FabricType::all();
            $compositions = Composition::all();
            $fabric_treatments = FabricTreatments::all();
            $yarn_counts = YarnCount::all();
            $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();

            $ListOfOrders = BasicOrder::with('buyer')->get();
            $lots = DB::table('inventory_setup_order_lots')->where('order_id', $id)->get();
            $colors = Color::all();
            $sizes = Size::all();

            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $basicorder = BasicOrder::findOrFail($id);
            return view('inventory::database.basicorders.show', compact('basicorder', 'basicorders', 'buyers', 'organizations', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'tab', 'lots', 'colors', 'sizes'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $basicorder = BasicOrder::findOrFail($id);
        return view('inventory::database.basicorders.edit', compact('basicorder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicOrderRequest $request, $id)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            BasicOrder::findOrFail($id)->update($request->validated());
            DB::commit();
            $basicorders = BasicOrder::all();
            $buyers = Buyer::all();
            $organizations = Organization::all();
            $product_categories = ProductCategory::all();
            $merchandisers = User::all();
            $fabric_types = FabricType::all();
            $compositions = Composition::all();
            $fabric_treatments = FabricTreatments::all();
            $yarn_counts = YarnCount::all();
            $yarn_categories = DB::table('inventory_setup_yarn_categories')->get();
            //DB::enableQueryLog();
            $ListOfOrders = BasicOrder::with('buyer')->get();
            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $tab = 2;
            $basicorder = BasicOrder::findOrFail($id);
            return view('inventory::database.basicorders.show', compact('basicorder', 'basicorders', 'buyers', 'organizations', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'tab'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update basic order: ' . $th->getMessage());
        }
    }
    //storeLotsColorsSizes
    public function storeLotsColorsSizes(Request $request, $id)
    {
        // dd($request->all());
        // get the basic order
        $basicorder = BasicOrder::findOrFail($id);

        foreach ($request->lots as $lotInput) {
            $lot = $basicorder->lots()->create([
                'lot_no' => $lotInput['lot_no'],
                'po_no' => 1,
                'order_id' => $basicorder->id,
                'lot_status' => 1,
                'lot_quantity' => 1,
                'lot_remarks' => 1,
                'shipping_date' => 1,
                'expected_shipping_date' => 1,
                'actual_shipping_date' => 1,
            ]);
            // forcolor 
            foreach ($lotInput['colors'] as $colorInput) {
                $color = $lot->colors()->create([
                    'color_name' => $colorInput['color_name'],
                    'quantity' => $colorInput['quantity'],
                    'lot_id' => $lot->id,
                ]);
            }
            // for size
            foreach ($lotInput['sizes'] as $sizeInput) {
                $size = $lot->sizes()->create([
                    'size_name' => $sizeInput['size_name'],
                    'quantity' => $sizeInput['quantity'],
                    'lot_id' => $lot->id,
                ]);
            }
        }
        DB::beginTransaction();
        try {
            DB::commit();
            return redirect()->route('inventory.database.basicorders.show', $id)->with('success', 'Lots colors sizes stored successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to store lots colors sizes: ' . $th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            BasicOrder::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('inventory.database.basicorders.index')->with('success', 'Basic Order deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete basic order: ' . $th->getMessage());
        }
    }
}
