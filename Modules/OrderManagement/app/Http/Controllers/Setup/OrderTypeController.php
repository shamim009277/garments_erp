<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\OrderType;
use Modules\OrderManagement\Http\Requests\Setup\OrderTypeRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class OrderTypeController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:inventory.ordertypes.view')->only('index','show');
    //     $this->middleware('permission:inventory.ordertypes.add')->only('store');
    //     $this->middleware('permission:inventory.ordertypes.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.ordertypes.delete')->only('destroy');
    // }
   
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderTypes = OrderType::all();
        return view('ordermanagement::setup.ordertypes.index', compact('orderTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.ordertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderTypeRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $orderType = OrderType::create([
                'order_type' => $request->order_type,
                'is_active' => $request->is_active,
                
            ]);
            // return $orderType;
            DB::commit();
            return redirect()->route('ordermanagement.setup.ordertypes.index')->with('success', 'Order Type created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create order type: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $orderType = OrderType::findOrFail($id);
        return view('ordermanagement::setup.ordertypes.show', compact('orderType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $orderType = OrderType::findOrFail($id);
        return view('ordermanagement::setup.ordertypes.edit', compact('orderType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderTypeRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $orderType = OrderType::findOrFail($id);
            $orderType->update([
                'order_type' => $request->order_type,
                'is_active' => $request->is_active,
                
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.ordertypes.index')->with('success', 'Order Type updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update order type: ' . $e->getMessage());
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
            $orderType = OrderType::findOrFail($id);
            $orderType->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Order Type deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order type: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, OrderType::class);
    }
}
