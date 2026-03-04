<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\BrandCategory;
use Modules\OrderManagement\Http\Requests\Setup\BrandCategoryRequest;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BrandCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandCategories = BrandCategory::with('organization')->get();
        $organizations = Organization::all();
        
        return view('ordermanagement::setup.brandcategories.index', compact('brandCategories', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('ordermanagement.setup.brandcategories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            BrandCategory::create([
                'category_name' => $request->category_name,
                'category_code' => $request->category_code,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.brandcategories.index')->with('success', 'Brand Category created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create brand category: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('ordermanagement.setup.brandcategories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return redirect()->route('ordermanagement.setup.brandcategories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $brandCategory = BrandCategory::findOrFail($id);
            $brandCategory->update([
                'category_name' => $request->category_name,
                'category_code' => $request->category_code,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.brandcategories.index')->with('success', 'Brand Category updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update brand category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $brandCategory = BrandCategory::findOrFail($id);
            $brandCategory->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.brandcategories.index')->with('success', 'Brand Category deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete brand category: ' . $e->getMessage());
        }
    }
}
