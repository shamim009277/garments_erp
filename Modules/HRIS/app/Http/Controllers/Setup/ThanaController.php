<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Thana;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Http\Requests\Setup\ThanaRequest;
use App\Traits\ToggleStatus;

class ThanaController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.thanas.view')->only('index');
        $this->middleware('permission:hris.thanas.add')->only('store');
        $this->middleware('permission:hris.thanas.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.thanas.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $thanas = Thana::with('district:id,name')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('bn_name', 'like', "%{$search}%")
                      ->orWhereHas('district', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                  });
        })
        ->paginate(50)
        ->withQueryString();

        $districts = District::active()->pluck('name', 'id')->toArray();
        return view('hris::setup.thana.index', compact('thanas', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThanaRequest $request) {
        try {
            Thana::create($request->validated());
            return redirect()->route('hris.setup.thanas.index')->with('success', 'Thana created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create thana: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThanaRequest $request, $id) {
        try {
            $thana = Thana::findOrFail($id);
            $thana->update($request->validated());
            return redirect()->route('hris.setup.thanas.index')->with('success', 'Thana updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update thana: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Thana::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Thana deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Thana deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Thana::class);
    }
}
