<?php

namespace Modules\Payroll\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\Payroll\Models\Database\Punishment;
use Modules\Payroll\Http\Requests\Database\PunishmentRequest;

class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $startDate = $today->copy()->startOfMonth()->toDateString();
        $endDate = $today->copy()->endOfMonth()->toDateString();
        $period = Carbon::parse($startDate)->toPeriod($endDate);

        $organizations = Organization::active()->pluck('short_name', 'id');
        $categories = EmployeeCategory::active()->pluck('category', 'category_code');
        $departments = Department::active()->pluck('department', 'id');

        $punishments = Punishment::with(['employee' => function ($query) {
            $query->select('id', 'employee_id', 'name');
        }])->active()->whereBetween('punishment_date', [$startDate, $endDate])->get();

        return view('payroll::database.punishment.index', compact('startDate', 'endDate', 'period', 'organizations', 'categories', 'departments', 'punishments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payroll::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PunishmentRequest $request) {
        try {
            $rows = [];
            foreach ($request->punishment_date as $date) {
                $exists = Punishment::where('employee_id', $request->employee_id)->where('punishment_date', $date)->first();
                if ($exists) {
                    return response()->json(['error' => 'Date already exists'], 422);
                }
                $rows[] = [
                    'employee_id' => $request->employee_id,
                    'punishment_date' => $date,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                ];
            }
            Punishment::insert($rows);
            return response()->json(['success' => 'Punishment added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('payroll::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('payroll::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        $id = $request->id;
        Punishment::destroy($id);
        return response()->json(['success' => 'Punishment deleted successfully']);
    }

    public function employeeInfo(Request $request){
        $employees = Employee::with([
            'department' => function ($q) use ($request) {
                $q->select('id', 'department')
                  ->when($request->department_id, fn($q) => $q->where('id', $request->department_id));
            },
            'designation' => function ($q) use ($request) {
                $q->select('id', 'designation', 'category_code')
                  ->when($request->employee_category_id, fn($q) => $q->where('category_code', $request->employee_category_id));
            },
            'organization' => function ($q) {
                $q->select('id', 'short_name');
            },
        ])
        ->select('id', 'employee_id', 'name', 'org_id', 'department_id', 'designation_id')
        ->where('org_id', $request->org_id)
        ->when($request->department_id, fn($q) => $q->where('department_id', $request->department_id))
        ->when($request->employee_category_id, fn($q) => $q->where('category_code', $request->employee_category_id))
        ->get();

        return response()->json($employees);
    }
}
