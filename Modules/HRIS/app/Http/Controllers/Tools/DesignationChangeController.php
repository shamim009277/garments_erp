<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Organization;
class DesignationChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $designations = Designation::where('is_active', 1)->pluck('designation', 'id');
        $departments = Department::where('is_active', 1)->pluck('department', 'id');
        $organizations = Organization::where('is_active', 1)->pluck('short_name', 'id');
        return view('hris::tools.designationchange.index', compact('employees', 'designations', 'departments', 'organizations'));
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
