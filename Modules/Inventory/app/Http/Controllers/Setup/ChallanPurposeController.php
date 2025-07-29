<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\ChallanPurpose;
use Modules\Inventory\Http\Requests\Setup\ChallanPurposeRequest;
use App\Traits\ToggleStatus;

class ChallanPurposeController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challanpurposes = ChallanPurpose::all();
        return view('inventory::setup.challanpurposes.index', compact('challanpurposes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.challanpurposes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChallanPurposeRequest $request) {
        $data = $request->validated();
        ChallanPurpose::create($data);
        return redirect()->route('inventory.setup.challanpurposes.index')->with('success', 'Challan Purpose created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $challanpurpose = ChallanPurpose::find($id);
        return view('inventory::setup.challanpurposes.show', compact('challanpurpose'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $challanpurpose = ChallanPurpose::find($id);
        return view('inventory::setup.challanpurposes.edit', compact('challanpurpose'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChallanPurposeRequest $request, $id) {
        $data = $request->validated();
        ChallanPurpose::find($id)->update($data);
        return redirect()->route('inventory.setup.challanpurposes.index')->with('success', 'Challan Purpose updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        ChallanPurpose::find($id)->delete();
        return redirect()->route('inventory.setup.challanpurposes.index')->with('success', 'Challan Purpose deleted successfully');
    }
}
