<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Inventory\Models\Setup\Color;
use Modules\Inventory\Models\Setup\ColorGroup;
use Modules\Inventory\Http\Requests\Setup\ColorRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class ColorController extends Controller
{
    use ToggleStatus;
    // $table->id();
    // $table->string('color_code', 20)->unique();
    // $table->string('color_name', 100);
    // $table->char('color_hex', 7)->nullable();
    // $table->unsignedBigInteger('color_group_id');
    // $table->foreign('color_group_id')
    //     ->references('id')
    //     ->on('inventory_setup_color_groups')
    //     ->onDelete('restrict');

    // $table->boolean('is_active')->default(true);
    // $table->timestamps();
    public function index()
    {
        $colors = Color::all();
        $colorGroups = ColorGroup::all();
        return view('inventory::setup.colors.index', compact('colors', 'colorGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colorGroups = ColorGroup::all();
        return view('inventory::setup.colors.create', compact('colorGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            //create color code with prefix INV-
            $color_code = 'INV-' . str_pad(Color::count() + 1, 3, '0', STR_PAD_LEFT);
            //check if color code exists
            if (Color::where('color_code', $color_code)->exists()) {
                return redirect()->back()->with('error', 'Color code already exists');
            }
            $color_name = $request->color_name;
            $color_hex = $request->color_hex;
            $color_group_id = $request->color_group_id;
            $is_active = $request->is_active;
            $color = Color::create([
                'color_code' => $color_code,
                'color_name' => $color_name,
                'color_hex' => $color_hex,
                'color_group_id' => $color_group_id,
                'is_active' => $is_active,
            ]);
            $color->save();
            DB::commit();
            return redirect()->route('inventory.setup.colors.index')->with('success', 'Color created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Color: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $color = Color::findOrFail($id);
        $colorGroups = ColorGroup::all();
        return view('inventory::setup.colors.show', compact('color', 'colorGroups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        $colorGroups = ColorGroup::all();
        return view('inventory::setup.colors.edit', compact('color', 'colorGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $color = Color::findOrFail($id);
            $color_code = $request->color_code;
            $color_name = $request->color_name;
            $color_hex = $request->color_hex;
            $color_group_id = $request->color_group_id;
            $is_active = $request->is_active;
            $color->update([
                'color_code' => $color_code,
                'color_name' => $color_name,
                'color_hex' => $color_hex,
                'color_group_id' => $color_group_id,
                'is_active' => $is_active,
            ]);
            $color->save();
            DB::commit();
            return redirect()->route('inventory.setup.colors.index')->with('success', 'Color updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Color: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $color = Color::findOrFail($id);
            $color->delete();
            DB::commit();
            return redirect()->route('inventory.setup.colors.index')->with('success', 'Color deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete Color: ' . $e->getMessage());
        }
    }
    
    public function toggleStatus($id) {
        return $this->toggleStatusTrait($id, Color::class);
    }
}
