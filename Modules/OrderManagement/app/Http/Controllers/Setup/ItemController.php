<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\OrderManagement\Models\Setup\Item;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Models\Setup\GoodsSubCategory;
use App\Models\Master\Setup\Unit;
use Modules\OrderManagement\Http\Requests\Setup\ItemRequest;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    use ToggleStatus;

    // function __construct()
    // {
    //     $this->middleware('permission:ordermanagement.items.view')->only('index','show');
    //     $this->middleware('permission:ordermanagement.items.add')->only('store');
    //     $this->middleware('permission:ordermanagement.items.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:ordermanagement.items.delete')->only('destroy');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubCategory::all();
        $units = Unit::all();
        return view('ordermanagement::setup.items.index', compact('items', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubCategory::all();
        $units = Unit::all();
        return view('ordermanagement::setup.items.create', compact('goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'IT';
            $length = 3;
            $lastSerial = DB::table('inventory_setup_items')
                ->where('item_code', 'like', $prefix . '%')
                ->orderBy('item_code', 'desc')
                ->value('item_code');
            $lastNumber = (int) substr($lastSerial, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            $newItemCode = $prefix . $newNumber;
            $item = Item::create([
                'item_code' => $newItemCode,
                'item_name' => $request->item_name,
                'item_description' => $request->item_description,
                'item_barcode' => $request->item_barcode,
                'item_image' => $request->item_image,
                'goods_category_id' => $request->goods_category_id,
                'goods_subcategory_id' => $request->goods_subcategory_id,
                'unit_id' => $request->unit_id,
                'model' => $request->model,
                'type' => $request->type,
                'remarks' => $request->remarks,
                'present_stock' => 0,
                'minimum_stock' => 0,
                'maximum_stock' => 0,
                'reorder_level' => 0,
                'reorder_quantity' => 0,
                'is_active' => true
            ]);
            DB::commit();
            return redirect()->route('ordermanagements.setup.items.index')->with('success', 'Item created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubCategory::all();
        $units = Unit::all();
        return view('ordermanagement::setup.items.show', compact('item', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubCategory::all();
        $units = Unit::all();
        return view('ordermanagement::setup.items.edit', compact('item', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update([
            'item_name' => $request->item_name,
            'goods_category_id' => $request->goods_category_id,
            'goods_subcategory_id' => $request->goods_subcategory_id,
            'unit_id' => $request->unit_id,
            'model' => $request->model,
            'type' => $request->type,
            'remarks' => $request->remarks,
            
        ]);
        return redirect()->route('ordermanagements.setup.items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
/*    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('ordermanagement.setup.items.index')->with('success', 'Item deleted successfully');
    }*/
    
    public function destroy(Request $request) {
        try {
            Item::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Item deletion failed: ' . $e->getMessage()]);
        }
    }
    //toggleStatus
    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Item::class);
    }
    //getSubcategories
    public function getSubcategories(Request $request)
    {
        $category_id = $request->category_id;
        if(!$category_id){
            return response()->json('<option value="">Select a subcategory</option>');
        }
        $subcategories = GoodsSubCategory::where('goods_category_id', $category_id)
        ->select('id', 'name')
        ->orderBy('name')
        ->get();

    return response()->json($subcategories);
        
    }
    
}
