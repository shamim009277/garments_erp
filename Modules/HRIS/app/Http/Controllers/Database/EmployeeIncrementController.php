<?php

namespace Modules\HRIS\Http\Controllers\Database;

use App\Exports\EmployeeIncrementExport;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeIncrementImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\HRIS\Models\Database\EmployeeIncrement;
use Modules\HRIS\Models\Setting;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\Organization;

class EmployeeIncrementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.employee-increment.view')->only('index');
        $this->middleware('permission:hris.employee-increment.add')->only(['store','downloadSample']);
    }
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
        $incrementTypes = DB::table('hris_setup_increment_types')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->id . ' || ' . $item->increment_type];
            });
        return view('hris::database.employeeincrement.index', compact('departments', 'organizations', 'employeeCategories', 'lastMonthStart', 'lastMonthEnd', 'hroption', 'incrementTypes'));
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
    public function store(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new EmployeeIncrementImport($request->house_rent_basic), $request->file('file'));

            return back()->with('success', 'Employee increments imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

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

    public function downloadSample(){
        return Excel::download(new EmployeeIncrementExport, 'increment.xlsx');
    }
}
