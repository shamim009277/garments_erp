<?php

namespace Modules\HRIS\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Http\Requests\Database\IndividualIncrementRequest;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Modules\HRIS\Models\Database\IndividualIncrement;
use Modules\HRIS\Models\Setting;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\LeaveClassification;

class IndividualIncrementController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:hris.individual-increment.view')->only('index');
        $this->middleware('permission:hris.individual-increment.add')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date=Carbon::now()->format('Y-m-d');
        $leave_types = LeaveClassification::pluck('signification','code');
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $hroption = Setting::active()->first();
        $types = DB::table('hris_setup_increment_types')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->id . ' || ' . $item->increment_type];
            });
        $designations = Designation::where('is_active', 1)->pluck('designation', 'id');
        $departments = Department::where('is_active', 1)->pluck('department', 'id');
        return view('hris::database.individualincrement.index',compact('date','leave_types','types','lastMonthStart','lastMonthEnd','hroption','designations','departments'));
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
    public function store(IndividualIncrementRequest $request) {
        //dd($request->all());
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $empSalary = EmployeeSalary::with([
                'employee:id,employee_id,department_id,designation_id,line,unit'
            ])
            ->where('employee_id', intval($data['employee_id']))
            ->first();

            if (!$empSalary) {
                return redirect()->back()->with('error', 'Employee salary information not found');
            }

            IndividualIncrement::create([
                'org_id'              => $empSalary->org_id ?? null,
                'employee_id'         => $data['employee_id'],
                'department_id'       => $empSalary->employee->department_id,
                'designation_id'      => $empSalary->employee->designation_id,
                'line'                => $empSalary->employee->line,
                'unit'                => $empSalary->employee->unit,
                'new_department_id'   => $data['new_department_id'],
                'new_designation_id'  => $data['new_designation_id'],
                'gross_salary'        => $empSalary->gross_salary ?? null,
                'basic'               => $empSalary->basic ?? null,
                'medical_allowance'   => $empSalary->medical_allowance ?? null,
                'home_allowance'      => $empSalary->home_allowance ?? null,
                'food_allowance'      => $empSalary->food_allowance ?? null,
                'conveyance'          => $empSalary->conveyance ?? null,
                'increment_date'      => $data['increment_date'] ?? null,
                'effective_date'      => $data['effective_date'] ?? null,
                'arrear_upto_date'    => $data['arrear_upto_date'] ?? null,
                'increment_type_id'   => $data['increment_type_id'] ?? null,
                'increment_value'     => $data['increment_amount'] ?? null,
                'amount'              => $data['increment_amount'],
                'house_rent_basic'    => $empSalary->house_rent_basic ?? null,
                'remarks'             => $data['remarks'] ?? null,
                'created_by'          => auth()->id(),
                'updated_by'          => auth()->id(),
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Individual Increment Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
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

    public function getLeaveInfo(Request $request)
    {
        $employee = Employee::with(['designation:id,designation,category_code','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate','employeeSalary:employee_id,gross_salary','organization:id,short_name'])
                  ->where('employee_id', (int)$request->employee_id)
                  ->select('id','employee_id','name','designation_id','department_id','joining_date','photo','org_id')
                  ->first();

        return response()->json([
           'employee' => $employee,
        ]);
    }
}
