<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\SourceReference;
use Modules\HRIS\Http\Requests\Setup\SourceReferenceRequest;
use App\Traits\ToggleStatus;

class SourceReferenceController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sourcereferences = SourceReference::all();
        return view('hris::setup.sourcereference.index', compact('sourcereferences'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SourceReferenceRequest $request) {
        try {
            SourceReference::create($request->validated());
            return redirect()->route('hris.setup.sourcereferences.index')->with('success', 'Source Reference created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create source reference: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SourceReferenceRequest $request, $id) {
        try {
            $sourcereference = SourceReference::findOrFail($id);
            $sourcereference->update($request->validated());
            return redirect()->route('hris.setup.sourcereferences.index')->with('success', 'Source Reference updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update source reference: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $sourcereference = SourceReference::findOrFail($request->id);
            $sourcereference->delete();
            return redirect()->route('hris.setup.sourcereferences.index')->with('success', 'Source Reference deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete source reference: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, SourceReference::class);
    }
}
