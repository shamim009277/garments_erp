<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\DepartureReason;
use Modules\HRIS\Models\Database\Employee;
class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departurereasons = DepartureReason::where('is_active', 1)->pluck('reason', 'id');
        $employees = Employee::where('is_active', 1)->pluck('name', 'id');
        return view('hris::tools.departure.index', compact('departurereasons', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
