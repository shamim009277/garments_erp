<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\Inventory\Http\Requests\Setup\ColorGroupRequest;
use Modules\Inventory\Models\Setup\ColorGroup;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;    
class ColorGroupController extends Controller
{


    use ToggleStatus;

     function __construct()
    {
        $this->middleware('permission:inventory.color-groups.view')->only('index','show');
        $this->middleware('permission:inventory.color-groups.add')->only('store');
        $this->middleware('permission:inventory.color-groups.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:inventory.color-groups.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('This is the index method of ColorGroupController');
        $colorGroups = ColorGroup::all();
        return view('inventory::setup.colorgroups.index', compact('colorGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.colorgroups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorGroupRequest $request)
    {
        DB::beginTransaction();
        try {
            $prifix = 'CG';
            $length = 2;
            $colorGroup = ColorGroup::create([
                'group_code' => $prifix . str_pad(ColorGroup::count() + 1, $length, '0', STR_PAD_LEFT),
                'group_name' => $request->group_name,
                'is_active' => $request->is_active,
            ]);
            $colorGroup->save();
            DB::commit();
            return redirect()->route('inventory.setup.colorgroups.index')->with('success', 'Color Group created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Color Group: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $colorGroup = ColorGroup::findOrFail($id);
        return view('inventory::setup.colorgroups.show', compact('colorGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $colorGroup = ColorGroup::findOrFail($id);
        return view('inventory::setup.colorgroups.edit', compact('colorGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorGroupRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $colorGroup = ColorGroup::findOrFail($id);
            $colorGroup->update($request->validated());
            $colorGroup->save();
            DB::commit();
            return redirect()->route('inventory.setup.colorgroups.index')->with('success', 'Color Group updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Color Group: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $colorGroup = ColorGroup::findOrFail($id);
            $colorGroup->delete();
            DB::commit();
            return redirect()->route('inventory.setup.colorgroups.index')->with('success', 'Color Group deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete Color Group: ' . $e->getMessage());
        }
    }
    //
    public function toggleStatus($id) {
        return $this->toggleStatusTrait($id, ColorGroup::class);
    }
   
}
