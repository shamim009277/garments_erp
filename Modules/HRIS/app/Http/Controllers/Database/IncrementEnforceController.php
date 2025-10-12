<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Modules\HRIS\Models\Database\EmployeeIncrement;


class IncrementEnforceController extends Controller
{

    function __construct() {
        $this->middleware('permission:hris.increment-enforce.view')->only('index');
        $this->middleware('permission:hris.increment-enforce.add')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $datas = EmployeeIncrement::with(['employeeBasic:id,employee_id,joining_date,name','department:id,department','designation:id,designation','newDepartment:id,department','newDesignation:id,designation'])->notEnforce()->notDiscard()->whereBetween('increment_date', [$lastMonthStart, $lastMonthEnd])->active()->get();
        return view('hris::database.incrementenforce.index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ids = (array) $request->input('id');

        if($request->form == 1){
            if (!empty($ids)) {
                try {
                    $alreadyDiscarded = EmployeeIncrement::whereIn('id', $ids)
                        ->discard()
                        ->count();

                    if ($alreadyDiscarded > 0) {
                        return response()->json([
                            'status'  => 'warning',
                            'message' => $alreadyDiscarded . ' record(s) already discarded!',
                        ]);
                    }

                    EmployeeIncrement::whereIn('id', $ids)->update([
                        'discard' => 1,
                    ]);

                    return response()->json([
                        'ids'     => $ids,
                        'status'  => 'success',
                        'message' => 'Data discarded successfully',
                    ]);
                } catch (\Throwable $th) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => $th->getMessage(),
                    ], 500);
                }
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'No data selected for discarded',
            ], 422);
        }else if($request->form == 2){
            if (!empty($ids)) {
                try {
                    DB::beginTransaction();

                    // 1. Check already enforced
                    $alreadyEnforced = EmployeeIncrement::whereIn('id', $ids)->enforce()->count();

                    if ($alreadyEnforced > 0) {
                        return response()->json([
                            'status'  => 'warning',
                            'message' => $alreadyEnforced . ' record(s) already enforced!',
                        ]);
                    }

                    // 2. Load increments + salaries together
                    $incrementDatas = EmployeeIncrement::with('employeeSalary')
                        ->whereIn('id', $ids)
                        ->active()
                        ->notEnforce()
                        ->notDiscard()
                        ->get();

                    foreach ($incrementDatas as $incrementData) {
                        $empSalary = $incrementData->employeeSalary;
                        if (!$empSalary) {
                            continue;
                        }

                        // salary calculation
                        $initial_salary = ($incrementData->gross_salary + $incrementData->amount);
                        $medical        = $incrementData->medical_allowance;
                        $food           = $incrementData->food_allowance;
                        $convey         = $incrementData->conveyance;
                        $house_percent  = (int) $incrementData->house_rent_basic;

                        $total_allowance = $medical + $food + $convey;

                        $basic = 0;
                        if (($initial_salary - $total_allowance) > 0 && ($house_percent + 100) > 0) {
                            $basic = round(($initial_salary - $total_allowance) / (($house_percent + 100) / 100));
                        }

                        // update employee salary (current + old)
                        $empSalary->update([
                            'gross_salary'        => $initial_salary,
                            'basic'               => $basic,
                            'home_allowance'      => $basic,
                            'medical_allowance'   => $medical,
                            'food_allowance'      => $food,
                            'conveyance'          => $convey,

                            'old_gross_salary'    => $incrementData->gross_salary,
                            'old_basic'           => $incrementData->basic,
                            'old_home_allowance'  => $incrementData->home_allowance,
                            'old_medical_allowance' => $incrementData->medical_allowance,
                            'old_food_allowance'  => $incrementData->food_allowance,
                            'old_conveyance'      => $incrementData->conveyance,
                        ]);
                    }
                    EmployeeIncrement::whereIn('id', $ids)->update([
                        'enforce' => 1,
                    ]);

                    DB::commit();

                    return response()->json([
                        'ids'     => $ids,
                        'status'  => 'success',
                        'message' => 'Data enforced successfully',
                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return response()->json([
                        'status'  => 'error',
                        'message' => $th->getMessage(),
                    ], 500);
                }
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'No data selected for discarded',
            ], 422);
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
