<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Country;
use Modules\OrderManagement\Http\Requests\Setup\BuyerRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:inventory.buyers.view')->only('index','show');
    //     $this->middleware('permission:inventory.buyers.add')->only('store');
    //     $this->middleware('permission:inventory.buyers.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.buyers.delete')->only('destroy');
    // }
   
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::all();
        $countries = Country::all();
        return view('ordermanagement::setup.buyers.index', compact('buyers', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('inventory::setup.buyers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuyerRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $buyer_code = 'BY' . str_pad(Buyer::count() + 1, 3, '0', STR_PAD_LEFT);
            $buyer = Buyer::create([
                'buyer_code' => $buyer_code,
                'buyer_name' => $request->buyer_name,
                'buyer_type' => $request->buyer_type,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'fax' => $request->fax,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'website' => $request->website,
                'is_active' => $request->is_active,
                
            ]);
            // return $buyer;
            DB::commit();
            return redirect()->route('ordermanagements.setup.buyers.index')->with('success', 'Buyer created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create buyer: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $buyer = Buyer::findOrFail($id);
        return view('ordermanagement::setup.buyers.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        $countries = Country::all();
        return view('ordermanagement::setup.buyers.edit', compact('buyer', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuyerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $buyer = Buyer::findOrFail($id);
            $buyer->update([
                'buyer_name' => $request->buyer_name,
                'buyer_type' => $request->buyer_type,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'fax' => $request->fax,
                'address' => $request->address,
                'country_id' => $request->country_id,
                'website' => $request->website,
                'is_active' => $request->is_active,
                
            ]);
            DB::commit();
            return redirect()->route('ordermanagements.setup.buyers.index')->with('success', 'Buyer updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update buyer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $buyer = Buyer::findOrFail($id);
            $buyer->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Buyer deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete buyer: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Buyer::class);
    }
}
