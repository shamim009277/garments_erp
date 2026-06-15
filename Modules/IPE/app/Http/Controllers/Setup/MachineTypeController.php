<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\IPE\Http\Requests\Setup\MachineTypeRequest;
use Modules\IPE\Models\Setup\MachineType;

class MachineTypeController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = MachineType::latest()->get();
        return view('ipe::setup.machinetype.index',compact('types'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(MachineTypeRequest $request) {
         try {
            MachineType::create($request->validated());
            return redirect()->back()->with('success', 'Machine type created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Machine type creation failed: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(MachineTypeRequest $request, $id) {
        try {
            $type = MachineType::findOrFail($id);
            $type->update($request->validated());
            return redirect()->back()->with('success', 'Machine type updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Machine type update failed: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            MachineType::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Machine type deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Machine type deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, MachineType::class);
    }
}
