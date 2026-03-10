<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Http\Requests\Setup\CountryRequest;
use Modules\OrderManagement\Models\Setup\Country;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
class CountryController extends Controller
{
    use ToggleStatus;

    //  function __construct()
    // {
    //     $this->middleware('permission:inventory.countries.view')->only('index','show');
    //     $this->middleware('permission:inventory.countries.add')->only('store');
    //     $this->middleware('permission:inventory.countries.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.countries.delete')->only('destroy');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return view('ordermanagement::setup.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordermanagement::setup.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request) {
        DB::beginTransaction();
        try {
            $country = Country::create($request->validated());
            // return $country;
            DB::commit();
            return redirect()->route('ordermanagement.setup.countries.index')->with('success', 'Country created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create country: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);
        return view('ordermanagement::setup.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('ordermanagement::setup.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, $id) {
        DB::beginTransaction();
        try {
            $country = Country::findOrFail($id);
            //unique check for country name if it is changed then update
            $uniqueCheck = Country::where('country_name', $request->country_name)->where('id', '!=', $id)->exists();
            if ($uniqueCheck) {
                return redirect()->back()->with('error', 'Country name already exists');
            }
            if ($request->country_name != $country->country_name) {
                $country->country_name = $request->country_name;
                $country->country_code = $request->country_code;
                $country->is_active = $request->is_active;
                $country->currency = $request->currency;
                $country->currency_code = $request->currency_code;
                $country->currency_symbol = $request->currency_symbol;
                $country->exchange_rate = $request->exchange_rate;
                $country->description = $request->description;
                $country->save();
            }
            DB::commit();
            return redirect()->route('ordermanagement.setup.countries.index')->with('success', 'Country updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update country: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        DB::beginTransaction();
        try {
            $country = Country::findOrFail( $request->id);
            $country->delete();
            DB::commit();
            return redirect()->route('ordermanagement.setup.countries.index')->with('success', 'Country deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete country: ' . $e->getMessage());
        }
    }

    //toggleStatus
    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Country::class);
    }
}
