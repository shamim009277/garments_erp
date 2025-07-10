<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Thana;
use Modules\HRIS\Models\Setup\Union;
use Modules\HRIS\Http\Requests\Setup\UnionRequest;
use App\Traits\ToggleStatus;

class UnionController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $unions = Union::with('thana:id,name')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('bn_name', 'like', "%{$search}%")
                      ->orWhereHas('thana', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                  });
        })
        ->paginate(50)
        ->withQueryString();

        $thanas = Thana::active()->pluck('name', 'id')->toArray();
        return view('hris::setup.union.index', compact('unions', 'thanas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnionRequest $request)
    {
        try {
            $validated = $request->validated();
            Union::create($validated);
            return redirect()->route('hris.setup.unions.index')->with('success', 'Union created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create union: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnionRequest $request, $id) {
        try {
            $union = Union::findOrFail($id);
            $union->update($request->validated());
            return redirect()->route('hris.setup.unions.index')->with('success', 'Union updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update union: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            Union::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Union deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Union deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, Union::class);
    }
}
