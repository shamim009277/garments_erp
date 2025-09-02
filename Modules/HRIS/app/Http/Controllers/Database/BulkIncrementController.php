<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Http\Requests\Database\BulkIncrementRequest;

class BulkIncrementController extends Controller
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
        //dd($hroption);
        return view('hris::database.bulkincrement.index', compact('departments', 'organizations', 'employeeCategories', 'lastMonthStart', 'lastMonthEnd', 'hroption'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BulkIncrementRequest $request) {

        $from = Carbon::parse($request->joining_date_from)->format('m-d');
        $to   = Carbon::parse($request->joining_date_to)->format('m-d');
        $oneYearAgo = Carbon::now()->subYear()->format('Y-m-d');

        $employees = Employee::with(['designation' => function($q) use ($request) {
                $q->select('id', 'designation', 'category_code');
            }])
            ->select('id', 'employee_id', 'name', 'org_id','designation_id')
            ->where('org_id', $request->org_id)
            ->where('reason', 'N')
            ->where('joining_date', '<=', $oneYearAgo)
            ->when(!$request->all_department && $request->department_id, fn($q) =>
                $q->where('department_id', $request->department_id)
            )
            ->when(!$request->all_category && $request->employee_category_id, fn($q) =>
                $q->whereHas('designation', fn($d) =>
                    $d->where('category_code', $request->employee_category_id)
                )
            )
            ->when($request->joining_date_from && $request->joining_date_to, fn($q) =>
                $q->whereRaw("DATE_FORMAT(joining_date, '%m-%d') BETWEEN ? AND ?", [$from, $to])
            )
            ->when($request->designation_id, fn($q) =>
                $q->whereIn('designation_id', $request->designation_id)
            )
            ->get();


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



    public function fetchDesignation(Request $request) {
        $designations = Employee::with([
            'designation' => function ($q) use ($request) {
                $q->select('id', 'designation', 'category_code')
                  ->when($request->employee_category_id, fn($q) =>
                      $q->where('category_code', $request->employee_category_id)
                  );
            }
        ])
        ->select('id', 'designation_id', 'org_id')
        ->where('org_id', $request->org_id)
        ->where('reason', 'N')
        ->when($request->department_id, fn($q) =>
            $q->where('department_id', $request->department_id)
        )
        ->get()
        ->unique('designation_id')
        ->values();

        return response()->json($designations);
    }
}
