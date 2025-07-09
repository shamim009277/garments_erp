<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Division;
use Modules\HRIS\Http\Requests\Setup\DistrictRequest;
use App\Traits\ToggleStatus;

class DistrictController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::with(['division:id,name'])->get();
        $divisions = Division::active()->pluck('name', 'id')->toArray();
        return view('hris::setup.district.index', compact('districts', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request) {
        try {
            District::create($request->validated());
            return redirect()->route('hris.setup.districts.index')->with('success', 'District created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create district: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, $id) {
        try {
            $district = District::findOrFail($id);
            $district->update($request->validated());
            return redirect()->route('hris.setup.districts.index')->with('success', 'District updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update district: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            District::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'District deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'District deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, District::class);
    }
}
