<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;

class EmployeeIncrementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::active()->pluck('department', 'id');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $employeeCategories = EmployeeCategory::active()->pluck('category', 'category_code');
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $hroption = Setting::active()->first();
        return view('hris::database.employeeincrement.index', compact('departments', 'organizations', 'employeeCategories', 'lastMonthStart', 'lastMonthEnd', 'hroption'));
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
