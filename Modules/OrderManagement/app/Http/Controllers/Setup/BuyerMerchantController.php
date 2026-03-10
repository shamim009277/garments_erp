<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\BuyerMerchant;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\OrderManagement\Http\Requests\Setup\BuyerMerchantRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class BuyerMerchantController extends Controller
{
    use ToggleStatus;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyerMerchants = BuyerMerchant::with(['buyer', 'merchant', 'organization'])->get();
        $buyers = Buyer::all();
        $merchants = Employee::where('department_id',15)->get();
        $organizations = Organization::all();
        return view('ordermanagement::setup.buyermerchants.index', compact('buyerMerchants', 'buyers', 'merchants', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = Buyer::all();
        $merchants = Employee::all();
        $organizations = Organization::all();
        return view('ordermanagement::setup.buyermerchants.index', compact('buyers', 'merchants', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuyerMerchantRequest $request)
    {
        DB::beginTransaction();
        try {
            BuyerMerchant::create([
                'buyer_id' => $request->buyer_id,
                'merchant_id' => $request->merchant_id,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.buyermerchants.index')->with('success', 'Buyer Merchant created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create buyer merchant: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $buyerMerchant = BuyerMerchant::with(['buyer', 'merchant', 'organization'])->findOrFail($id);
        return view('ordermanagement::setup.buyermerchants.index', compact('buyerMerchant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buyerMerchant = BuyerMerchant::findOrFail($id);
        $buyers = Buyer::all();
        $merchants = Employee::all();
        $organizations = Organization::all();
        return view('ordermanagement::setup.buyermerchants.index', compact('buyerMerchant', 'buyers', 'merchants', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuyerMerchantRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $buyerMerchant = BuyerMerchant::findOrFail($id);
            $buyerMerchant->update([
                'buyer_id' => $request->buyer_id,
                'merchant_id' => $request->merchant_id,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.buyermerchants.index')->with('success', 'Buyer Merchant updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update buyer merchant: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $buyerMerchant = BuyerMerchant::findOrFail($id);
            $buyerMerchant->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.buyermerchants.index')->with('success', 'Buyer Merchant deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete buyer merchant: ' . $e->getMessage());
        }
    }
}
