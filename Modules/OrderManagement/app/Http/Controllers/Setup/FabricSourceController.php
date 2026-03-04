<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\FabricSource;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Modules\OrderManagement\Http\Requests\Setup\FabricSourceRequest;

class FabricSourceController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $fabricSources = FabricSource::all();
        return view('ordermanagement::setup.fabricsource.index', compact('fabricSources'));
    }

    public function create()
    {
        return view('ordermanagement::setup.fabricsource.create');
    }

    public function store(FabricSourceRequest $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'FS';
            $length = 3;
            $fabricSource = FabricSource::create([
                'fabric_source_code' => $prefix . str_pad(FabricSource::count() + 1, $length, '0', STR_PAD_LEFT),
                'fabric_source_name' => $request->fabric_source_name,
                'fabric_source_description' => $request->fabric_source_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.fabricsources.index')->with('success', 'Fabric Source created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create fabric source: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('ordermanagement::setup.fabricsource.show');
    }

    public function edit($id)
    {
        $fabricSource = FabricSource::findOrFail($id);
        return view('ordermanagement::setup.fabricsource.edit', compact('fabricSource'));
    }

    public function update(FabricSourceRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $fabricSource = FabricSource::findOrFail($id);
            $fabricSource->update([
                'fabric_source_name' => $request->fabric_source_name,
                'fabric_source_description' => $request->fabric_source_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.fabricsources.index')->with('success', 'Fabric Source updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update fabric source: ' . $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            $fabricSource = FabricSource::findOrFail($id);
            $fabricSource->delete();
            return response()->json(['success' => true, 'message' => 'Fabric Source deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete fabric source']);
        }
    }
}
