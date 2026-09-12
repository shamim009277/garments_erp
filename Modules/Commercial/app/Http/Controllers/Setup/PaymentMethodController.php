<?php

namespace Modules\Commercial\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ToggleStatus;
use Modules\Commercial\Http\Requests\Setup\PaymentMethodRequest;
use Modules\Commercial\Models\Setup\PaymentMethod;

class PaymentMethodController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::query()->get();
        return view('commercial::setup.paymentmethod.index', compact('payment_methods'));
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
    public function store(PaymentMethodRequest $request) {
        try {
            $payment_method = PaymentMethod::query()->create($request->validated());
            return redirect()->back()->with('success', 'Payment Method Created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
    public function update(PaymentMethodRequest $request, $id) {
        try {
            $payment_method = PaymentMethod::query()->findOrFail($id);
            $payment_method->update($request->validated());
            return redirect()->back()->with('success', 'Payment Method Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $payment_method = PaymentMethod::query()->findOrFail($id);
            $payment_method->delete();
            return redirect()->back()->with('success', 'Payment Method Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(PaymentMethodRequest $request) {
        return $this->ToggleStatusTrait($request, PaymentMethod::class);
    }
}
