<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Document;
use Modules\HRIS\Http\Requests\Setup\DocumentRequest;
use App\Traits\ToggleStatus;

class DocumentController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.document.view')->only('index');
        $this->middleware('permission:hris.document.add')->only('store');
        $this->middleware('permission:hris.document.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.document.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::all();
        return view('hris::setup.document.index', compact('documents'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request) {
        try {
            Document::create($request->validated());
            return redirect()->route('hris.setup.documents.index')->with('success', 'Document created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create document: ' . $th->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentRequest $request, $id) {
        try {
            $document = Document::findOrFail($id);
            $document->update($request->validated());
            return redirect()->route('hris.setup.documents.index')->with('success', 'Document updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update document: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Document::findOrFail($request->id)->delete();
            return redirect()->route('hris.setup.documents.index')->with('success', 'Document deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete document: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Document::class);
    }
}
