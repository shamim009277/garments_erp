<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\LeaveClassification;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Carbon\Carbon;

class LeaveAllController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $leave_types = LeaveClassification::pluck('signification','code');
        $employeeCategories = EmployeeCategory::active()->pluck('category', 'category_code');
        $date=Carbon::now()->format('Y-m-d');
        return view('hris::database.leaveall.index', compact('parentDepartments','leave_types','date','employeeCategories'));
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
