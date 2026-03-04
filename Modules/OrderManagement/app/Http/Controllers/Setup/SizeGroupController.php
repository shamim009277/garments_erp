<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\SizeGroup;
use Modules\OrderManagement\Http\Requests\Setup\SizeGroupRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class SizeGroupController extends Controller
{
    use ToggleStatus;


    // function __construct()
    // {
    //     $this->middleware('permission:ordermanagement.size-wise-groups.view')->only('index','show');
    //     $this->middleware('permission:ordermanagement.size-wise-groups.add')->only('store');
    //     $this->middleware('permission:ordermanagement.size-wise-groups.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:ordermanagement.size-wise-groups.delete')->only('destroy');
    // }








    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizeGroups = SizeGroup::all();
        return view('ordermanagement::setup.sizegroups.index', compact('sizeGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.sizegroups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeGroupRequest $request)
    {
        DB::beginTransaction();
        try {
            # code...
            $prifix = 'SG';
            $length = 2;
            $sizeGroup = SizeGroup::create([
                'size_group_code' => $prifix . str_pad(SizeGroup::count() + 1, $length, '0', STR_PAD_LEFT),
                'size_group_name' => $request->size_group_name,
                'is_active' => $request->is_active,
            ]);
            $sizeGroup->save();
            DB::commit();
            return redirect()->route('ordermanagements.setup.sizegroups.index')->with('success', 'Size Group created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Size Group: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ordermanagement::setup.sizegroups.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sizeGroup = SizeGroup::findOrFail($id);
        return view('ordermanagement::setup.sizegroups.edit', compact('sizeGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeGroupRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $sizeGroup = SizeGroup::findOrFail($id);
            $sizeGroup->update([
                'size_group_name' => $request->size_group_name,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagements.setup.sizegroups.index')->with('success', 'Size Group updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Size Group: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $sizeGroup = SizeGroup::findOrFail($id);
            $sizeGroup->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Size Group deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Size Group: ' . $e->getMessage(),
            ]);
        }
    }
    
    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, SizeGroup::class);
    }
}
