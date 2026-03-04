<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\Composition;
use Modules\OrderManagement\Http\Requests\Setup\CompositionRequest;
use Illuminate\Support\Facades\DB;

class CompositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // function __construct()
    // {
    //     $this->middleware('permission:inventory.compositions.view')->only('index','show');
    //     $this->middleware('permission:inventory.compositions.add')->only('store');
    //     $this->middleware('permission:inventory.compositions.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.compositions.delete')->only('destroy');
    // }


    public function index()
    {
        $compositions = Composition::all();
        return view('ordermanagement::setup.compositions.index', compact('compositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.compositions.create');
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

        return redirect()->route('ordermanagements.setup.compositions.index')->with('success', 'Composition created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ordermanagement::setup.compositions.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ordermanagement::setup.compositions.edit');
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

        return redirect()->route('ordermanagements.setup.compositions.index')->with('success', 'Composition updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $composition = Composition::findOrFail($id);
            $composition->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Composition deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Composition: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->toggleStatusTrait($request, Composition::class);
    }
}
