<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\IPE\Http\Requests\Setup\MachineProcessRequest;
use Modules\IPE\Models\Setup\MachineProcess;
use Modules\IPE\Models\Setup\MachineType;

class MachineProcessController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processes = MachineProcess::latest()->get();
        $machines = MachineType::active()->latest()->get();
        $lists = collect($machines)->pluck('name', 'id');

        return view('ipe::setup.machineprocesses.index', compact('processes','machines','lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ipe::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MachineProcessRequest $request) {
        try {
            MachineProcess::create($request->validated());
            return redirect()->back()->with('success', 'Machine Process created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create machine process: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ipe::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ipe::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MachineProcessRequest $request, $id) {
        try {
            $process = MachineProcess::findOrFail($id);
            $process->update($request->validated());
            return redirect()->back()->with('success', 'Machine Process updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update process: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            MachineProcess::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Machine Process deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Machine Process deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, MachineProcess::class);
    }
}
