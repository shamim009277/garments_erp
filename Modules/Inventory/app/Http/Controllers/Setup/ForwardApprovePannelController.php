<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Inventory\Models\Setup\Item;
use Modules\Inventory\Models\Setup\GoodsCategory;
use Modules\Inventory\Models\Setup\GoodsSubcategory;
use App\Models\Master\Setup\Unit;

use Modules\Inventory\Http\Requests\Setup\ItemRequest;
use Modules\Inventory\Http\Requests\Setup\ForwardApprovePannelRequest;

use Modules\Inventory\Models\Setup\ForwardApprovePannel;
use Modules\HRIS\Models\Setup\Organization;
use App\Models\User;


use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\DB;

class ForwardApprovePannelController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forapppannels = ForwardApprovePannel::all();
        $users = User::all();
        $organizations = Organization::all();
        $access_types = ['1' => 'Forward', '2' => 'Pricing','3' => 'Confirmation','4' => 'Approval','5' => 'Final Approval'];
        
        return view('inventory::setup.forapppannel.index', compact('forapppannels', 'users','organizations','access_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $goodsCategories = User::all();
        $users = User::all();
        $organizations = Organization::all();
        $access_types = ['1' => 'Forward', '2' => 'Pricing','3' => 'Confirmation','4' => 'Approval','5' => 'Final Approval'];
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.forapppannel.index', compact('items', 'goodsCategories', 'goodsSubcategories', 'units','users','organizations','access_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ForwardApprovePannelRequest $request)
    {

        $data = $request->validated();
        $employee = User::find($data['user_id']); 
        $data['employee_id'] = $employee->employee_id;
        $data['email'] = $employee->email;
        DB::beginTransaction();
        try {
            $item = ForwardApprovePannel::create($data);
            DB::commit();
            return redirect()->route('inventory.setup.forapppannel.index')->with('success', 'Forward Approve Pannel created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Forward Approve Pannel: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $item = ForwardApprovePannel::findOrFail($id);
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
        $item = ForwardApprovePannel::findOrFail($id);
        $goodsCategories = GoodsCategory::all();
        $goodsSubcategories = GoodsSubcategory::all();
        $units = Unit::all();
        return view('inventory::setup.items.edit', compact('item', 'goodsCategories', 'goodsSubcategories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ForwardApprovePannelRequest $request, $id)
    {
        $data = $request->validated();
        // return $data;
        $employee = User::find($data['user_id']); 
        $data['employee_id'] = $employee->employee_id;
        $data['email'] = $employee->email;
        $item = ForwardApprovePannel::findOrFail($id);
        $item->update($data);
        return redirect()->route('inventory.setup.forapppannel.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            ForwardApprovePannel::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Forward Approve Pannel deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Forward Approve Pannel deletion failed: ' . $e->getMessage()]);
        }
    
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, ForwardApprovePannel::class);
    }
}
