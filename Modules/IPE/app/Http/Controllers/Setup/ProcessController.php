<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\IPE\Http\Requests\Setup\ProcessRequest;
use Modules\IPE\Models\Setup\Process;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processes = Process::active()->latest()->get();
        return view('ipe::setup.processes.index', compact('processes'));
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
    public function store(ProcessRequest $request) {
        try {
            Process::create($request->validated());
            return redirect()->route('ipe.setup.processes.index')->with('success', 'Process created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create process: ' . $e->getMessage());
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
    public function update(ProcessRequest $request, $id) {
        try {
            $process = Process::findOrFail($id);
            $process->update($request->validated());
            return redirect()->route('ipe.setup.processes.index')->with('success', 'Process updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update process: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Process::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Process deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Process deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Process::class);
    }
}
