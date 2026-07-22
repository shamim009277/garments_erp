<?php

namespace Modules\HRIS\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\ProcessAttendence;

class HRISController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = (Auth::user()->access_id == 0) ? Organization::active()->pluck('short_name', 'id') : Organization::active()->where('id', Auth::user()->access_id)->pluck('short_name', 'id');
        $companyWiseEmployees = Organization::active()
            ->get()
            ->map(function ($organization) {
                return [
                    'name' => $organization->name,
                    'short_name' => $organization->short_name ?: $organization->name,
                    'total' => Employee::active()->where('org_id', $organization->id)->count(),
                ];
            })
            ->filter(fn($item) => $item['total'] > 0)
            ->sortByDesc('total')
            ->values();


        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd   = Carbon::now()->endOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd   = Carbon::now()->subMonth()->endOfMonth();

        $companyWiseMovement = Organization::active()
            ->get()
            ->map(function ($organization) use (
                $currentMonthStart,
                $currentMonthEnd,
                $lastMonthStart,
                $lastMonthEnd
            ) {

                $employee = Employee::where('org_id', $organization->id)
                    ->selectRaw("
                COUNT(*) as total,

                SUM(
                    CASE
                        WHEN joining_date BETWEEN ? AND ?
                        THEN 1 ELSE 0
                    END
                ) as current_month_joining,

                SUM(
                    CASE
                        WHEN joining_date BETWEEN ? AND ?
                        THEN 1 ELSE 0
                    END
                ) as last_month_joining,

                SUM(
                    CASE
                        WHEN leaving_date BETWEEN ? AND ?
                        THEN 1 ELSE 0
                    END
                ) as current_month_resigned,

                SUM(
                    CASE
                        WHEN leaving_date BETWEEN ? AND ?
                        THEN 1 ELSE 0
                    END
                ) as last_month_resigned
            ", [
                        $currentMonthStart,
                        $currentMonthEnd,
                        $lastMonthStart,
                        $lastMonthEnd,
                        $currentMonthStart,
                        $currentMonthEnd,
                        $lastMonthStart,
                        $lastMonthEnd,
                    ])
                    ->first();

                return [
                    'name'                    => $organization->name,
                    'short_name'              => $organization->short_name ?: $organization->name,
                    'total'                   => (int) $employee->total,
                    'last_month_joining'      => (int) $employee->last_month_joining,
                    'current_month_joining'   => (int) $employee->current_month_joining,
                    'last_month_resigned'     => (int) $employee->last_month_resigned,
                    'current_month_resigned'  => (int) $employee->current_month_resigned,
                ];
            })
            ->filter(fn($item) => $item['total'] > 0)
            ->sortByDesc('total')
            ->values();


        $currentDate = now()->toDateString();

        $companyAttendance = Organization::active()
            ->get()
            ->map(function ($organization) use ($currentDate) {

                $totalEmployee = Employee::active()
                    ->where('org_id', $organization->id)
                    ->count();

                $punchedEmployee = ProcessAttendence::query()
                    ->whereDate('work_date', $currentDate)
                    ->whereHas('employee', function ($query) use ($organization) {
                        $query->active()
                            ->where('org_id', $organization->id);
                    })
                    ->distinct('employee_id')
                    ->count('employee_id');

                return [
                    'company' => $organization->short_name ?: $organization->name,
                    'total_employee' => $totalEmployee,
                    'punched_employee' => $punchedEmployee,
                    'not_punched' => max($totalEmployee - $punchedEmployee, 0),
                    'attendance_rate' => $totalEmployee > 0
                        ? round(($punchedEmployee / $totalEmployee) * 100, 1)
                        : 0,
                ];
            })
            ->sortByDesc('total_employee')
            ->values();


        // $companyWiseMovement = [
        //     [
        //         'short_name' => 'ANG',
        //         'last_month_joining' => 15,
        //         'current_month_joining' => 18,
        //         'last_month_resigned' => 5,
        //         'current_month_resigned' => 7,
        //     ],
        //     [
        //         'short_name' => 'APL',
        //         'last_month_joining' => 20,
        //         'current_month_joining' => 25,
        //         'last_month_resigned' => 8,
        //         'current_month_resigned' => 6,
        //     ],
        //     [
        //         'short_name' => 'BGL',
        //         'last_month_joining' => 12,
        //         'current_month_joining' => 16,
        //         'last_month_resigned' => 4,
        //         'current_month_resigned' => 5,
        //     ],
        //     [
        //         'short_name' => 'KTL',
        //         'last_month_joining' => 10,
        //         'current_month_joining' => 14,
        //         'last_month_resigned' => 3,
        //         'current_month_resigned' => 4,
        //     ],
        //     [
        //         'short_name' => 'MTL',
        //         'last_month_joining' => 18,
        //         'current_month_joining' => 20,
        //         'last_month_resigned' => 7,
        //         'current_month_resigned' => 6,
        //     ],
        //     [
        //         'short_name' => 'NBL',
        //         'last_month_joining' => 14,
        //         'current_month_joining' => 19,
        //         'last_month_resigned' => 5,
        //         'current_month_resigned' => 8,
        //     ],
        //     [
        //         'short_name' => 'RDL',
        //         'last_month_joining' => 16,
        //         'current_month_joining' => 21,
        //         'last_month_resigned' => 6,
        //         'current_month_resigned' => 7,
        //     ],
        //     [
        //         'short_name' => 'STL',
        //         'last_month_joining' => 11,
        //         'current_month_joining' => 13,
        //         'last_month_resigned' => 2,
        //         'current_month_resigned' => 3,
        //     ],
        // ];

        return view('hris::index', compact('companyWiseEmployees', 'organizations', 'companyWiseMovement','companyWiseMovement','companyAttendance'));
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
