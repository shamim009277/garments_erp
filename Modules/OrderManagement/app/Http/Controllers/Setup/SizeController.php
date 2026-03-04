<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Modules\OrderManagement\Http\Requests\Setup\SizeRequest;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\OrderManagement\Models\Setup\SizeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class SizeController extends Controller
{
    use ToggleStatus;
    
    // $table->string('size_code', 20)->unique();
    //         $table->string('size_name', 100);
    //         $table->integer('size_rank')->nullable();
    //         $table->boolean('is_active')->default(true);
    //         $table->unsignedBigInteger('size_group_id');


    // function __construct()
    // {
    //     $this->middleware('permission:inventory.sizes.view')->only('index','show');
    //     $this->middleware('permission:inventory.sizes.add')->only('store');
    //     $this->middleware('permission:inventory.sizes.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.sizes.delete')->only('destroy');
    // }







    public function index()
    {
        $sizes = Size::all();
        $sizeGroups = SizeGroup::all();
        return view('ordermanagement::setup.sizes.index', compact('sizes', 'sizeGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request) {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $prifix = 'SZ';
            $length = 2;
            $size = Size::create([
                'size_code' => $prifix . str_pad(Size::count() + 1, $length, '0', STR_PAD_LEFT),
                'size_name' => $request->size_name,
                'size_rank' => $request->size_rank,
                'is_active' => $request->is_active,
                'size_group_id' => $request->size_group_id,
            ]);
            $size->save();
            DB::commit();
            return redirect()->route('ordermanagement.setup.sizes.index')->with('success', 'Size created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Size: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $size = Size::findOrFail($id);
        return view('ordermanagement::setup.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        $sizeGroups = SizeGroup::all();
        return view('ordermanagement::setup.sizes.edit', compact('size', 'sizeGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request, $id) {
        
        DB::beginTransaction();
        try {
            $size = Size::findOrFail($id);
            $sizeGroup = SizeGroup::findOrFail($request->size_group_id);
            $size->update([
                'size_name' => $request->size_name,
                'size_rank' => $request->size_rank,
                'is_active' => $request->is_active,
                'size_group_id' => $sizeGroup->id,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.sizes.index')->with('success', 'Size updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Size: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        DB::beginTransaction();
        try {
            $size = Size::findOrFail($id);
            $size->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Size deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Size: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->toggleStatusTrait($request, Size::class);
    }
}
