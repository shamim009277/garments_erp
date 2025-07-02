<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administration\Module;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Administration\ModuleRequest;
use App\Traits\ToggleStatus;

class ModuleController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:administration.module.view')->only('index');
        $this->middleware('permission:administration.module.create')->only('store');
        $this->middleware('permission:administration.module.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:administration.module.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::select('id', 'name', 'url', 'is_active')->get();
        return view('administration.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuleRequest $request)
    {
        try {
            Module::create($request->validated());
            return redirect()->back()->with('success', 'Module created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Module creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $module = Module::findOrFail($id);
        return view('administration.module.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $module = Module::findOrFail($id);
        return view('administration.module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuleRequest $request, string $id)
    {
        try {
            Module::findOrFail($id)->update($request->validated());
            return redirect()->back()->with('success', 'Module updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Module update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Module::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Module deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Module deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Module::class);
    }
}
