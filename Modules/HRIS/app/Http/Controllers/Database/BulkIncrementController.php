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
use Modules\HRIS\Models\Database\EmployeeIncrement;
use Modules\HRIS\Http\Requests\Database\BulkIncrementRequest;

class BulkIncrementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.bulk-increment.view')->only('index');
        $this->middleware('permission:hris.bulk-increment.add')->only('store');
        $this->middleware('permission:hris.bulk-increment.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.bulk-increment.delete')->only('destroy');
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
            ->with(['employeeSalary' => function($q) {
                $q->select('id', 'employee_id', 'gross_salary', 'basic', 'medical_allowance', 'home_allowance', 'food_allowance', 'conveyance');
            }])
            ->select('id', 'employee_id', 'name', 'org_id','designation_id','department_id','line','unit')
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

            try {
                $incrementSource   = $request->increment_source;
                $incrementType     = $request->increment_value_type;
                $amount            = $request->amount;

                $commonData = [
                    'increment_date'     => $request->increment_date,
                    'effective_date'     => $request->effective_date,
                    'arrear_upto_date'   => $request->arrear_upto_date,
                    'increment_type_id'  => null,
                    'increment_source'   => $incrementSource,
                    'increment_value_type' => $incrementType,
                    'increment_value' => $amount,
                    'house_rent_basic'   => $request->house_rent_basic,
                    'enforce'            => 0,
                    'remarks'            => $request->remarks,
                    'is_active'          => true,
                    'created_by'         => Auth::id(),
                    'updated_by'         => Auth::id(),
                ];
                $incrementMonth = Carbon::parse($request->increment_date)->format('Y-m');

                $chunks = collect($employees)->chunk(100);

                foreach ($chunks as $chunk) {
                    $rows = [];

                    foreach ($chunk as $employee) {
                        $salary = $employee->employeeSalary;

                        // চেক করা হবে, একই মাসে আগে থেকে ইনক্রিমেন্ট আছে কিনা
                        $alreadyExists = EmployeeIncrement::where('employee_id', $employee->employee_id)
                            ->whereRaw("DATE_FORMAT(increment_date, '%Y-%m') = ?", [$incrementMonth])
                            ->exists();

                        if ($alreadyExists) {
                            continue;
                        }

                        $baseSalary = $incrementSource === 'B'
                            ? $salary->basic
                            : $salary->gross_salary;

                        $incrementValue = $incrementType === 'P'
                            ? round($baseSalary * ($amount / 100))
                            : round($baseSalary + $amount);

                        $rows[] = array_merge($commonData, [
                            'employee_id'        => $employee->employee_id,
                            'org_id'             => $employee->org_id,
                            'department_id'      => $employee->department_id,
                            'designation_id'     => $employee->designation_id,
                            'line'               => $employee->line??0,
                            'unit'               => $employee->unit??0,
                            'new_department_id'  => $employee->department_id,
                            'new_designation_id' => $employee->designation_id,
                            'gross_salary'       => $salary->gross_salary,
                            'basic'              => $salary->basic,
                            'medical_allowance'  => $salary->medical_allowance,
                            'home_allowance'     => $salary->home_allowance,
                            'food_allowance'     => $salary->food_allowance,
                            'conveyance'         => $salary->conveyance,
                            'amount'             => $incrementValue,
                        ]);
                    }
                    if (!empty($rows)) {
                        EmployeeIncrement::insert($rows);
                        return redirect()->back()->with('success', 'Bulk increment created successfully');
                    }else{
                        return redirect()->back()->with('error', 'No data found for this selection');
                    }
                }
            } catch (\Throwable $th) {
                 return redirect()->back()->with('error', $th->getMessage());
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
