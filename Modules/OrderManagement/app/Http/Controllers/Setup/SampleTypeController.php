<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\SampleType;
use Modules\OrderManagement\Http\Requests\Setup\SampleTypeRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class SampleTypeController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $sampletypes = SampleType::orderBy('id', 'desc')->get();
        return view('ordermanagement::setup.sampletypes.index', compact('sampletypes'));
    }

    public function store(SampleTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            
            // Generate code (e.g., ST001)
            $lastSampleType = SampleType::orderBy('id', 'desc')->first();
            $newId = $lastSampleType ? $lastSampleType->id + 1 : 1;
            $data['sample_type_code'] = 'ST' . str_pad($newId, 3, '0', STR_PAD_LEFT);
            
            SampleType::create($data);
            
            DB::commit();
            return redirect()->back()->with('success', 'Sample Type created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $sampleType = SampleType::findOrFail($id);
        return response()->json($sampleType);
    }

    public function update(SampleTypeRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $sampleType = SampleType::findOrFail($id);
            $sampleType->update($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Sample Type updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $sampleType = SampleType::findOrFail($request->id);
            $sampleType->delete();
            return redirect()->back()->with('success', 'Sample Type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
