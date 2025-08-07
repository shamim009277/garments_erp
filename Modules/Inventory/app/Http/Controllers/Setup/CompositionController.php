<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Models\Setup\Composition;
use Modules\Inventory\Http\Requests\Setup\CompositionRequest;
use Illuminate\Support\Facades\DB;

class CompositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compositions = Composition::all();
        return view('inventory::setup.compositions.index', compact('compositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::setup.compositions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompositionRequest $request)
    {
       DB::beginTransaction();
       try {
           $prifix = 'CP';
           $lastId = Composition::max('id');
           $lastId = $lastId ? $lastId + 1 : 1;
           $length = 2;
           $composition = Composition::create([
               'composition_code' => $prifix . str_pad($lastId, $length, '0', STR_PAD_LEFT),
               'composition_name' => $request->composition_name,
               'composition_description' => $request->composition_description,
               'is_active' => $request->is_active,
           ]);
           $composition->save();
           
       } catch (\Throwable $th) {
           DB::rollBack();
           throw $th;
       }
       DB::commit();

        return redirect()->route('inventory.setup.compositions.index')->with('success', 'Composition created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventory::setup.compositions.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('inventory::setup.compositions.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompositionRequest $request, $id)
       {
        $request->validate([
            'composition_name' => 'required',
            'composition_description' => 'nullable',
            'is_active' => 'required',
        ]);

        $composition = Composition::findOrFail($id);
        $composition->update($request->all());

        return redirect()->route('inventory.setup.compositions.index')->with('success', 'Composition updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $composition = Composition::findOrFail($id);
        $composition->delete();

        return redirect()->route('inventory.setup.compositions.index')->with('success', 'Composition deleted successfully');
    }
}
