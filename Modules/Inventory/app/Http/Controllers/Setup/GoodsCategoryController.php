<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Http\Requests\Setup\GoodsCategoryRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;


class GoodsCategoryController extends Controller
{
    use ToggleStatus;
    // $table->id();
    // $table->string('category_code', 20)->unique();  // e.g., RM01, FG02
    // $table->string('name', 100);                   // e.g., Raw Material, Finished Goods
    // $table->text('description')->nullable();       // Optional details
    // $table->unsignedBigInteger('parent_id')->nullable(); // For hierarchical categories
    // $table->boolean('is_active')->default(true);
    // $table->timestamps();
    // // Optional: Add foreign key if hierarchical
    // $table->foreign('parent_id')->references('id')->on('inventory_setup_goods_categories')->onDelete('set null');
    public function index()
    {
        $goodscategories = GoodsCategory::all();
        return view('inventory::setup.goodscategories.index', compact('goodscategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.goodscategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoodsCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $prefix = 'GC';
            $length = 2;
            $lastSerial = DB::table('inventory_setup_goods_categories')
                ->where('category_code', 'like', $prefix . '%')
                ->orderBy('category_code', 'desc')
                ->value('category_code');
            $lastNumber = (int) substr($lastSerial, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            $goodscategory = GoodsCategory::create([
                'category_code' => $prefix . $newNumber,
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('inventory.goodscategories.index')->with('success', 'Goods Category created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Goods Category: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $goodscategory = GoodsCategory::find($id);
        return view('inventory::setup.goodscategories.show', compact('goodscategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $goodscategory = GoodsCategory::find($id);
        return view('inventory::setup.goodscategories.edit', compact('goodscategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoodsCategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            GoodsCategory::find($id)->update($request->validated());
            DB::commit();
            return redirect()->route('inventory.goodscategories.index')->with('success', 'Goods Category updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Goods Category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         GoodsCategory::find($id)->delete();
    //         DB::commit();
    //         return redirect()->route('inventory.goodscategories.index')->with('success', 'Goods Category deleted successfully');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Failed to delete Goods Category: ' . $e->getMessage());
    //     }
    // }

    public function destroy(Request $request) {
        try {
            GoodsCategory::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Goods Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Goods Category deletion failed: ' . $e->getMessage()]);
        }
    }
    public function toggleStatus(Request $request) {
        
        return $this->ToggleStatusTrait($request, GoodsCategory::class);
    }
}
