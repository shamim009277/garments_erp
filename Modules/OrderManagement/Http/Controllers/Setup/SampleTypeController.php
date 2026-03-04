<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\SampleType;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Modules\OrderManagement\Http\Requests\Setup\SampleTypeRequest;

class SampleTypeController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $sampletypes = SampleType::all();
        return view('ordermanagement::setup.sampletypes.index', compact('sampletypes'));
    }

    public function create()
    {
        return view('ordermanagement::setup.sampletypes.create');
    }

    public function store(SampleTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'ST';
            $length = 3;
            $sampleType = SampleType::create([
                'sample_type_code' => $prefix . str_pad(SampleType::count() + 1, $length, '0', STR_PAD_LEFT),
                'sample_type_name' => $request->sample_type_name,
                'sample_type_description' => $request->sample_type_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.sampletypes.index')->with('success', 'Sample Type created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create sample type: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('ordermanagement::setup.sampletypes.show');
    }

    public function edit($id)
    {
        $sampleType = SampleType::findOrFail($id);
        return view('ordermanagement::setup.sampletypes.edit', compact('sampleType'));
    }

    public function update(SampleTypeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $sampleType = SampleType::findOrFail($id);
            $sampleType->update([
                'sample_type_name' => $request->sample_type_name,
                'sample_type_description' => $request->sample_type_description,
                'is_active' => $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.sampletypes.index')->with('success', 'Sample Type updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update sample type: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $sampleType = SampleType::findOrFail($id);
            $sampleType->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.sampletypes.index')->with('success', 'Sample Type deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete sample type: ' . $e->getMessage());
        }
    }
}
