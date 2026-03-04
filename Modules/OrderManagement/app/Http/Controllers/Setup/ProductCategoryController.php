<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Http\Requests\Setup\ProductCategoryRequest;
use Modules\OrderManagement\Models\Setup\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class ProductCategoryController extends Controller
{
    // $table->string('product_category_code', 20)->unique(); // Like PC001
    // $table->string('product_category_name', 100);
    // $table->string('product_category_description')->nullable();
    // $table->boolean('is_active')->default(true);

    use ToggleStatus;


    // function __construct()
    // {
    //     $this->middleware('permission:ordermanagement.product-categories.view')->only('index','show');
    //     $this->middleware('permission:ordermanagement.product-categories.add')->only('store');
    //     $this->middleware('permission:ordermanagement.product-categories.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:ordermanagement.product-categories.delete')->only('destroy');
    // }







    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('ordermanagement::setup.productcategories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $prifix = 'PC';
            $length = 3;
            $productCategory = ProductCategory::create([
                'product_category_code' => $prifix . str_pad(ProductCategory::count() + 1, $length, '0', STR_PAD_LEFT),
                'product_category_name' => $request->product_category_name,
                'product_category_description' => $request->product_category_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.productcategories.index')->with('success', 'Product Category created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Product Category: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ordermanagement::setup.productcategories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('ordermanagement::setup.productcategories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::findOrFail($id);
            $productCategory->update([
                'product_category_name' => $request->product_category_name,
                'product_category_description' => $request->product_category_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.productcategories.index')->with('success', 'Product Category updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Product Category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::findOrFail($id);
            $productCategory->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Product Category: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, ProductCategory::class);
    }
}
