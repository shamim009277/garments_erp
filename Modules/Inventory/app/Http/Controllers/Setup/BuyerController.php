<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Inventory\Models\Setup\Buyer;
use Modules\Inventory\Models\Setup\Country;

use Modules\Inventory\Http\Requests\Setup\BuyerRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    // $table->id();
    // $table->string('buyer_code', 20)->unique(); // Like BY001
    // $table->string('buyer_name', 100);
    // $table->enum('buyer_type', ['Local', 'Foreign', 'Both', 'Buying House', 'Retail', 'Online Seller'])->default('Local');
    // $table->string('contact_person')->nullable();
    // $table->string('email')->nullable();
    // $table->string('phone', 30)->nullable();
    // $table->string('mobile', 30)->nullable();
    // $table->string('fax', 30)->nullable();
    // $table->text('address')->nullable();
    // $table->string('website')->nullable();
    // $table->boolean('is_active')->default(true);
    // $table->foreignId('country_id')
    //     ->nullable()
    //     ->constrained('inventory_setup_goods_setup_country')
    //     ->onDelete('restrict');
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::all();
        $countries = Country::all();
        return view('inventory::setup.buyers.index', compact('buyers', 'countries'));
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
            DB::commit();
            return redirect()->route('inventory.setup.buyers.index')->with('success', 'Buyer created successfully');
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
        return view('inventory::setup.buyers.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        $countries = Country::all();
        return view('inventory::setup.buyers.edit', compact('buyer', 'countries'));
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
            return redirect()->route('inventory.setup.buyers.index')->with('success', 'Buyer updated successfully');
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
            return redirect()->route('inventory.setup.buyers.index')->with('success', 'Buyer deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete buyer: ' . $e->getMessage());
        }
    }
}
