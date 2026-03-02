<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Http\Requests\Tools\ShiftingListRequest;

class NewEmployeeShiftingListController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:hris.shifting-list-new-employee.view')->only('index');
        $this->middleware('permission:hris.shifting-list-new-employee.add')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::active()->pluck('short_name', 'id');
        return view('hris::tools.newshiftinglist.index',compact('organizations'));
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
    public function store(Request $request)
    {
        try {
            $startTime = microtime(true);
            date_default_timezone_set('Asia/Dhaka');

            $request->validate([
                'year' => 'required|integer|min:2000|max:' . now()->year,
            ]);

            $year = (int) $request->year;
            $yearEndDate = Carbon::create($year)->endOfYear();

            $employees = Employee::active()
                ->when($request->filled('organization_id'), fn ($q) =>
                    $q->where('org_id', $request->organization_id)
                )
                ->get();

            if ($employees->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No active employee found.');
            }

            $employeeIds = $employees->pluck('employee_id')->toArray();
            $existingEmployeeIds = ShiftingList::where('year', $year)
                ->when($request->filled('organization_id'), fn ($q) =>
                    $q->where('org_id', $request->organization_id)
                )
                ->pluck('employee_id')
                ->unique()
                ->toArray();

            $newEmployeeIds = array_diff($employeeIds, $existingEmployeeIds);
            if (empty($newEmployeeIds)) {
                return redirect()->back()->with('error', 'Shifting list already generated for this year.');
            }

            $shiftEmployees = $employees->whereIn('employee_id', $newEmployeeIds);
            $regularEmployees = $shiftEmployees->where('shifting_duty', 'N');
            $rotationalEmployees = $shiftEmployees->where('shifting_duty', 'Y');

            if ($regularEmployees->isEmpty() && $rotationalEmployees->isEmpty()) {
                return redirect()->back()->with('error', 'No employee found for shifting list.');
            }
            $totalInserted = 0;

            foreach ($regularEmployees->chunk(5) as $chunk) {
                $rows = [];
                foreach ($chunk as $employee) {
                    $startDate = Carbon::parse($employee->joining_date);
                    if ($startDate->gt($yearEndDate)) {
                        continue;
                    }
                    $date = $startDate->copy();
                    while ($date->lte($yearEndDate)) {
                        $rows[] = [
                            'year'        => $year,
                            'employee_id' => $employee->employee_id,
                            'org_id'      => $employee->org_id,
                            'date'        => $date->format('Y-m-d'),
                            'shift'       => $employee->refrerence_shift,
                            'created_by'  => Auth::id(),
                            'updated_by'  => Auth::id(),
                        ];

                        $date->addDay();
                    }
                }

                if (!empty($rows)) {
                    ShiftingList::insert($rows);
                    $totalInserted += count($rows);
                }
            }

            // ================= ROTATIONAL EMPLOYEES =================
            $previousShifts = ShiftingList::where('year', $year - 1)
                ->whereIn('employee_id', $rotationalEmployees->pluck('employee_id'))
                ->when($request->filled('organization_id'), fn ($q) =>
                    $q->where('org_id', $request->organization_id)
                )
                ->get()
                ->keyBy('employee_id');

            foreach ($rotationalEmployees->chunk(5) as $chunk) {
                $rows = [];
                foreach ($chunk as $employee) {
                    $startDate = Carbon::parse($employee->joining_date);
                    if ($startDate->gt($yearEndDate)) {
                        continue;
                    }
                    $changeday = Carbon::parse($employee->refrerence_holiday)
                        ->addDay()
                        ->format('l');
                    $currentShift = $previousShifts[$employee->employee_id]->shift
                        ?? $employee->refrerence_shift;
                    $date = $startDate->copy();

                    while ($date->lte($yearEndDate)) {
                        if ($date->format('l') === $changeday) {
                            $currentShift = match ($currentShift) {
                                'A' => 'C',
                                'C' => 'B',
                                'B' => 'A',
                                'M' => 'N',
                                'N' => 'M',
                                default => $currentShift,
                            };
                        }

                        $rows[] = [
                            'year'        => $year,
                            'employee_id' => $employee->employee_id,
                            'org_id'      => $employee->org_id,
                            'date'        => $date->toDateString(),
                            'shift'       => $currentShift,
                            'created_by'  => Auth::id(),
                            'updated_by'  => Auth::id(),
                        ];

                        $date->addDay();
                    }
                }
                if (!empty($rows)) {
                    ShiftingList::insert($rows);
                    $totalInserted += count($rows);
                }
            }
            $executionTime = round(microtime(true) - $startTime, 2);
            return redirect()->back()->with(
                'success',
                "Shifting list generated successfully. Total inserted: {$totalInserted} rows. Time taken: {$executionTime}s"
            );

        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
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
