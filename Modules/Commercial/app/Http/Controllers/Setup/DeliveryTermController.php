<?php

namespace Modules\Commercial\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ToggleStatus;
use Modules\Commercial\Http\Requests\Setup\DeliveryTermRequest;
use Modules\Commercial\Models\Setup\DeliveryTerm;

class DeliveryTermController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = DeliveryTerm::query()->get();
        return view('commercial::setup.deliveryterm.index', compact('terms'));
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
    public function store(DeliveryTermRequest $request) {
        try {
            $delivery_term = DeliveryTerm::query()->create($request->validated());
            return redirect()->back()->with('success', 'Delivery term created successfully.');
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
    public function update(DeliveryTermRequest $request, $id) {
        try {
            $delivery_term = DeliveryTerm::query()->find($id);
            $delivery_term->update($request->validated());
            return redirect()->back()->with('success', 'Delivery term updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $delivery_term = DeliveryTerm::query()->find($id);
            $delivery_term->delete();
            return redirect()->back()->with('success', 'Delivery term deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(DeliveryTermRequest $request) {
        return $this->ToggleStatusTrait($request, DeliveryTerm::class);
    }
}
