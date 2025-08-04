<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Inventory\Models\Setup\Item;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Models\Setup\GoodsSubcategory;
use App\Models\Master\Setup\Unit;
use Modules\Inventory\Http\Requests\Setup\ItemRequest;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.items.index', compact('items', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.items.create', compact('goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        DB::beginTransaction();
        try {
            $item = Item::create($request->validated());
            DB::commit();
            return redirect()->route('inventory.items.index')->with('success', 'Item created successfully');
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
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.items.show', compact('item', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.items.edit', compact('item', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->validated());
        return redirect()->route('inventory.items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('inventory.items.index')->with('success', 'Item deleted successfully');
    }
}
