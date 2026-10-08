<?php

namespace Modules\Commercial\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Modules\Commercial\Http\Requests\Setup\PaymentTermRequest;
use Modules\Commercial\Models\Setup\PaymentMethod;
use Modules\Commercial\Models\Setup\PaymentTerm;

class PaymentTermController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentTerms = PaymentTerm::query()->get();
        return view('commercial::setup.paymentterm.index', compact('paymentTerms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commercial::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentTermRequest $request) {
        try {
            $request->validated();
            PaymentTerm::query()->create($request->validated());
            return redirect()->back()->withSuccess('Payment term created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('commercial::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('commercial::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentTermRequest $request, $id) {
        try {
            $request->validated();
            PaymentTerm::query()->find($id)->update($request->validated());
            return redirect()->back()->withSuccess('Payment term updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            PaymentTerm::query()->find($id)->delete();
            return redirect()->back()->withSuccess('Payment term deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, PaymentTerm::class);
    }
}
