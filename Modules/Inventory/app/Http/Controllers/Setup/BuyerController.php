<?php

namespace Modules\Inventory\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Requests\Setup\BuyerRequest;
use Modules\Inventory\Models\Setup\Buyer;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // $table->string('buyer_name')->unique();
            // $table->string('country')->nullable();
            // $table->string('email')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('address')->nullable();
            // $table->string('status')->default('active');
            // $table->string('created_by')->nullable();
            // $table->string('updated_by')->nullable();
        // dd('This is the index method of BuyerController');
        // Fetch all buyers with pagination or any other logic as needed
        // For example:
        // $buyers = Buyer::paginate(10);
        $buyers = Buyer::paginate(10);

        return view('inventory::setup.buyers.index', compact('buyers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // dd($request->all());
       try {
            // Validate the request data
            $validatedData = $request->validate([
                'buyer_name' => 'required|string|max:30|unique:inventory_setup_buyer,buyer_name',
                'country' => 'required|string|max:100',
                'email' => 'required|string|max:60|unique:inventory_setup_buyer,email',
                'phone' => 'required|string',
                'address' => 'required|string',
            ]);

            // Create a new buyer
            Buyer::create($validatedData);

            return redirect()->back()->with('success', 'Buyer created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Buyer creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    // public function show($id)
    // {
    //     return view('inventory::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        dd('This is the edit method of BuyerController');
        return view('inventory::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        // dd($request->all());
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'buyer_name' => 'required|string|max:30|unique:inventory_setup_buyer,buyer_name,' . $id,
                'country' => 'required|string|max:100',
                'email' => 'required|string|max:60|unique:inventory_setup_buyer,email,' . $id,
                'phone' => 'required|string',
                'address' => 'required|string',
            ]);

            // Find the buyer and update it
            $buyer = Buyer::findOrFail($id);
            $buyer->update($validatedData);

            return redirect()->back()->with('success', 'Buyer updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Buyer update failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        dd('This is the destroy method of BuyerController');
        try {
            $buyer = Buyer::findOrFail($id);
            $buyer->delete();

            return redirect()->back()->with('success', 'Buyer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Buyer deletion failed: ' . $e->getMessage());
        }
    }
}
