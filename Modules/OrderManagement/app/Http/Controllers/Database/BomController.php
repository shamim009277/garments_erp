<?php

namespace Modules\OrderManagement\Http\Controllers\Database;

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
use Modules\Inventory\Models\Setup\Color;
use Modules\Inventory\Models\Setup\ColorGroup;
use Modules\Inventory\Models\Setup\Size;
use Modules\Inventory\Models\Setup\SizeGroup;
use Modules\Inventory\Models\Setup\OrderLotColorSize;

use Modules\Inventory\Http\Requests\Database\BasicOrderRequest;

use Modules\OrderManagement\Models\Setup\BomSetup;
use Modules\OrderManagement\Models\Setup\Item;
use Modules\Inventory\Models\Setup\Supplier;
use App\Models\Master\Setup\Unit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basicorders = BasicOrder::all();
        $buyers = Buyer::all();
        $organizations = Organization::all();
       
        //DB::enableQueryLog();
        $ListOfOrders = BasicOrder::with('buyer')->get();

        $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
        // dd($ListOfOrdersUniqueBuyer);




        return view('ordermanagement::database.boms.index', compact('basicorders', 'organizations', 'buyers', 'ListOfOrdersUniqueBuyer', 'ListOfOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::create');
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
                
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.database.basicorders.index')->with('success', 'Basic Order created successfully');
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
            // dd($request->all());
            $basicorders = BasicOrder::all();
            $buyers = Buyer::all();
            $organizations = Organization::all();
        
            //DB::enableQueryLog();
            $ListOfOrders = BasicOrder::with('buyer')->get();

            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $Orders = BasicOrder::where('id', $id)->first();
            // dd($Orders);
            $buy = $Orders->buyer_id;
            $boms = BomSetup::with(['buyer', 'organization', 'item', 'consumptionUnit', 'unit', 'supplier'])
                ->where('buyer_id', $buy)
                ->orderBy('id', 'desc')
                ->get();
            $buyers = Buyer::where('is_active', 1)->get();
            $buyerId = Buyer::findOrFail($buy);
            $items = Item::where('is_active', 1)->get();
            $units = Unit::active()->get();
            $suppliers = Supplier::where('is_active', 1)->get();
            $organizations = Organization::active()->get();

            return view('ordermanagement::database.boms.show', compact('basicorders', 'organizations', 'buyers', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'boms', 'buyers', 'buyerId', 'items', 'units', 'suppliers', 'organizations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $basicorder = BasicOrder::findOrFail($id);
        return view('ordermanagement::database.basicorders.edit', compact('basicorder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicOrderRequest $request, $id)
    {
        // dd($request->validated());
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
            $tab = 1;
            $basicorder = BasicOrder::findOrFail($id);
            return view('ordermanagement::database.basicorders.show', compact('basicorder', 'basicorders', 'buyers', 'organizations', 'product_categories', 'merchandisers', 'fabric_types', 'compositions', 'fabric_treatments', 'yarn_counts', 'yarn_categories', 'ListOfOrdersUniqueBuyer', 'ListOfOrders', 'tab'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update basic order: ' . $th->getMessage());
        }
    }


    public function updateLotsColorsSizes(Request $request, $id){
        
        $data = OrderLotColorSize::findOrFail($id);
        $data->size_quantity = $request->qty;
        $data->size_remarks = $request->remarks;
        $data->update();
        return response()->json(['success' => 'Size updated successfully']);

    }


    //storeLotsColorsSizes
    public function storeLotsColorsSizes(Request $request, $id)
    {
        // return response()->json($request->all());
        // get the basic order
        $basicorder = BasicOrder::findOrFail($id);
        $lot = $request->lot_id;
       
            // forcolor 
            foreach ($request->color_id as $color) {
               foreach ($request->size_name as $size) {
                $basicorder->sizes()->create([
                    'order_id' => $basicorder->id,
                    'lot_id' => $lot,
                    'color_id' => $color,
                    'size_id' => $size,
                ]);
            }
            }

        DB::beginTransaction();
        try {
            DB::commit();
            return redirect()->route('ordermanagement.database.basicorders.show', $id)->with('success', 'Lots colors sizes stored successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to store lots colors sizes: ' . $th->getMessage());
        }
    }
    //storeLots
    public function storeLots(Request $request, $id)
    {
        DB::beginTransaction();
        try {
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
            if(empty($lots)){
                $lots = [];
            }
            $colors = Color::all();
            $sizes = Size::all();

            $ListOfOrdersUniqueBuyer = $ListOfOrders->unique('buyer_id');
            $basicorder = BasicOrder::findOrFail($id);
            foreach ($request->lots as $lotInput) {
                $basicorder = BasicOrder::findOrFail($id);
                $lot = $basicorder->lots()->create([
                    'lot_no' => $lotInput['lot_no'],
                    'po_no' => $lotInput['po_no'],
                    'order_id' => $basicorder->id,
                    'lot_status' => 1,
                    'lot_quantity' => $lotInput['lot_quantity'],
                    'lot_remarks' => $lotInput['lot_remarks'],
                    'shipping_date' => $lotInput['shipping_date'],
                    'expected_shipping_date' => $lotInput['expected_shipping_date'],
                    'actual_shipping_date' => $lotInput['expected_shipping_date'],
                ]);
            }
            DB::commit();
            $tab = 2;
            return redirect()->back()->with('success', 'Lots stored successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to store lots: ' . $th->getMessage());
        }
    }
    //updateLots
    public function updateLots(Request $request, $id)
    {
        // dd($id, $request->all());
        DB::beginTransaction();
        try {
            $orderlot = DB::table('inventory_setup_order_lots')->where('id', $id)->update(
                [
                    'lot_quantity' => $request->lot_quantity,
                    'lot_remarks' => $request->lot_remarks,
                    'shipping_date' => $request->shipping_date,
                    'expected_shipping_date' => $request->expected_shipping_date,
                    'actual_shipping_date' => $request->expected_shipping_date,
                    'po_no' => $request->po_no,
                ]
            );
            DB::commit();
            $orderlot = DB::table('inventory_setup_order_lots')->where('id', $id)->first();
            // dd($orderlot);
            $tab = '?tab=2';
            $basicorders = BasicOrder::all();
            $basicorder = BasicOrder::where('id', $orderlot->order_id)->first();
            // dd($basicorder);
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
            $lots = DB::table('inventory_setup_order_lots')->where('id', $id)->get();
            // dd($lots);
            if(empty($lots)){
                $lots = [];
            }
            // dd($lots->count());
            $colors = Color::all();
            $sizes = Size::all();
            $tab = "{{ route('ordermanagement.database.basicorders.show', $basicorder->id) }}?tab=2";
            return redirect()->back()->with('success', 'Lots updated successfully');
            // return redirect()->route('inventory.database.basicorders.show', [$basicorder->id, $tab])->with('success', 'Lots updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update lots: ' . $th->getMessage());
        }
    }
    //storeColorsSizes
    public function storeColorsSizes(Request $request, $id)
    {
        // return response()->json($request->all());
        DB::beginTransaction();
        try {
            $basicorder = BasicOrder::findOrFail($id);
            $basicorder->colors()->create([
                'color_id' => $request->color_id,
                'order_id' => $basicorder->id,
            ]);
            $basicorder->sizes()->create([
                'size_id' => $request->size_id,
                'order_id' => $basicorder->id,
            ]);
            DB::commit();
            $tab = 3;
            return redirect()->back()->with('success', 'Colors and sizes stored successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to store colors and sizes: ' . $th->getMessage());
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            BasicOrder::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('ordermanagement.database.basicorders.index')->with('success', 'Basic Order deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete basic order: ' . $th->getMessage());
        }
    }


    //swift Url Calling 
    // getColors
    public function getColors($id){
        $colors = Color::all();
        return response()->json($colors);
    }
    //getSizes
    public function getSizes($id){
        $sizesgroup = SizeGroup::all();
        // dd($sizesgroup);
        return response()->json($sizesgroup);
    }
    //getSizesBySizeGroup
    public function getSizesBySizeGroup($id){
        $sizes = Size::where('size_group_id', $id)->get();
        return response()->json($sizes);
    }
}
