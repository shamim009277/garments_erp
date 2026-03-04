<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\OrderManagement\Models\Setup\YarnCount;
use App\Traits\ToggleStatus;
use Modules\OrderManagement\Http\Requests\Setup\YarnCountRequest;

class YarnCountController extends Controller
{
    use ToggleStatus;




    // function __construct()
    // {
    //     $this->middleware('permission:ordermanagement.yarn-counts.view')->only('index','show');
    //     $this->middleware('permission:ordermanagement.yarn-counts.add')->only('store');
    //     $this->middleware('permission:ordermanagement.yarn-counts.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:ordermanagement.yarn-counts.delete')->only('destroy');
    // }





    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yarnCounts = YarnCount::all();
        return view('ordermanagement::setup.yarncounts.index', compact('yarnCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.yarncounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(YarnCountRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'yarn_count_name' => 'required|unique:inventory_setup_yarn_counts,yarn_count_name',
                'yarn_count_description' => 'required',
                'is_active' => 'required',
            ]);
            $prifix = 'YC';
            $length = 4;
            $lastSerial = DB::table('inventory_setup_yarn_counts')
                ->where('yarn_count_code', 'like', $prifix . '%')
                ->orderBy('yarn_count_code', 'desc')
                ->value('yarn_count_code');
            if ($lastSerial) {
                $lastNumber = (int) substr($lastSerial, strlen($prifix));
            } else {
                $lastNumber = 0;
            }
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            $yarnCount = new YarnCount;
            $yarnCount->yarn_count_code = $prifix . $newNumber;
            $yarnCount->yarn_count_name = $request->yarn_count_name;
            $yarnCount->yarn_count_description = $request->yarn_count_description;
            $yarnCount->is_active = $request->is_active;
            $yarnCount->save();
            DB::commit();
            return redirect()->route('ordermanagement.setup.yarncounts.index')->with('success', 'Yarn Count created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create yarn count: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ordermanagement::setup.yarncounts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $yarnCount = YarnCount::findOrFail($id);
        return view('ordermanagement::setup.yarncounts.edit', compact('yarnCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(YarnCountRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $yarnCount = YarnCount::findOrFail($id);
            $yarnCount->yarn_count_name = $request->yarn_count_name;
            $yarnCount->yarn_count_description = $request->yarn_count_description;
            $yarnCount->is_active = $request->is_active;
            $yarnCount->save();
            DB::commit();
            return redirect()->route('ordermanagement.setup.yarncounts.index')->with('success', 'Yarn Count updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update yarn count: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $yarnCount = YarnCount::findOrFail($id);
            $yarnCount->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Yarn Count deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Yarn Count: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, YarnCount::class);
    }
}
