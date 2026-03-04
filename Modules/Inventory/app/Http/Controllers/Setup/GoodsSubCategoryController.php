<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\GoodsSubCategory;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\DB;

use Modules\Inventory\Http\Requests\Setup\GoodsSubCategoryRequest;


class GoodsSubCategoryController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:inventory.goods-sub-categories.view')->only('index','show');
        $this->middleware('permission:inventory.goods-sub-categories.add')->only('store');
        $this->middleware('permission:inventory.goods-sub-categories.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:inventory.goods-sub-categories.delete')->only('destroy');
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('This is the index method of GoodsSubCategoryController');
        $goodscategories = GoodsCategory::all();
        $goodsSubCategories = GoodsSubCategory::with('goodsCategory')->get();
        $organizations = Organization::all();
        return view('inventory::setup.goodsSubCategories.index', compact('goodsSubCategories', 'goodscategories', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.goodsSubCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoodsSubCategoryRequest $request) {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $prefix = 'GS';
            $length = 2;
            $lastSerial = DB::table('inventory_setup_goods_subcategories')
                ->where('sub_category_code', 'like', $prefix . '%')
                ->orderBy('sub_category_code', 'desc')
                ->value('sub_category_code');
            $lastNumber = (int) substr($lastSerial, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            $goodsSubCategory = GoodsSubCategory::create([
                'sub_category_code' => $prefix . $newNumber,
                'name' => $request->name,
                'bn_name' => $request->bn_name,
                'goods_category_id' => $request->goods_category_id,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.goodsSubCategories.index')->with('success', 'Goods Sub Category created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Goods Sub Category: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $goodsSubCategory = GoodsSubCategory::findOrFail($id);
        return view('inventory::setup.goodsSubCategories.show', compact('goodsSubCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $goodsSubCategory = GoodsSubCategory::findOrFail($id);
        return view('inventory::setup.goodsSubCategories.edit', compact('goodsSubCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoodsSubCategoryRequest $request, $id) {
        DB::beginTransaction();
        try {
            $goodsSubCategory = GoodsSubCategory::findOrFail($id);
            $goodsSubCategory->update([
                'name' => $request->name,
                'bn_name' => $request->bn_name,
                'goods_category_id' => $request->goods_category_id,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.setup.goodsSubCategories.index')->with('success', 'Goods Sub Category updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Goods Sub Category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        // // dd($id);
        // DB::beginTransaction();
        // try {
        //     $goodsSubCategory = GoodsSubCategory::findOrFail($id);
        //     dd($goodsSubCategory);
        //     $goodsSubCategory->delete();
        //     DB::commit();
        //     return redirect()->route('inventory.setup.goodsSubCategories.index')->with('success', 'Goods Sub Category deleted successfully');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'Failed to delete Goods Sub Category: ' . $e->getMessage());
        // }
        $goodsSubCategory = GoodsSubCategory::findOrFail($id);
        dd($goodsSubCategory);
        $goodsSubCategory->delete();
        return redirect()->route('inventory.setup.goodsSubCategories.index')->with('success', 'Goods Sub Category deleted successfully');
    }
    //getSubcategories
   
}
