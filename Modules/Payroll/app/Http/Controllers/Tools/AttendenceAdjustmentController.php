<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Http\Requests\Tools\AttendenceAdjustmentRequest;

class AttendenceAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $departmentIds = Employee::active()->where('ot_payable', 'Y')->distinct()->pluck('department_id')->toArray();
        $parentDepartments = ParentDepartment::with('departments')->orderBy('department', 'asc')->get();
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $types = ['1' => 'Adjust Start Punch', '2' => 'Adjust End Punch', '3' => 'Adjust Single Punch', '4' => 'Adjust Short Hours'];

        return view('payroll::tools.attendenceadjustment.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'employeeCategories', 'yearlist', 'month', 'types'));
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

    // public function store(AttendenceAdjustmentRequest $request)
    // {
    //     try {
    //         $startTime = microtime(true);
    //         $totalUpdated = 0;

    //         // Adjust Callback define globally
    //         $adjustCallback = function ($employees) use (&$totalUpdated, $request) {
    //             DB::transaction(function () use ($employees, &$totalUpdated, $request) {
    //                 // Shifts inside transaction
    //                 $baseShifts = Shift::active()->get()->keyBy('shift');
    //                 $companyShifts = CompanyWiseShift::active()
    //                     ->where('org_id', $request->organization_id)
    //                     ->get()
    //                     ->keyBy('shift');

    //                 foreach ($employees as $employee) {
    //                     $shift = $companyShifts[$employee->shift] ?? $baseShifts[$employee->shift] ?? null;
    //                     if (!$shift) continue;

    //                     $random = rand(0, 5);

    //                     switch ($request->adjust_type) {
    //                         case 1: // Late
    //                             $startPunch = Carbon::parse($employee->start_punch)
    //                                 ->subMinutes($employee->late_minutes + $random);

    //                             $actual = calculateActualHours($startPunch, $employee->end_punch, $shift->break_start, $shift->break_end);

    //                             $employee->update([
    //                                 'start_punch'  => $startPunch,
    //                                 'rwh'          => min(8, $actual['hours']),
    //                                 'is_late'      => 'N',
    //                                 'late_minutes' => 0,
    //                                 'total_hours'  => $actual['totalHours'],
    //                             ]);
    //                             break;

    //                         case 2: // Early Leave
    //                             $endPunch = Carbon::parse($employee->end_punch)
    //                                 ->addMinutes($employee->early_minutes + $random);

    //                             $actual = calculateActualHours($employee->start_punch, $endPunch, $shift->break_start, $shift->break_end);

    //                             $employee->update([
    //                                 'end_punch'      => $endPunch,
    //                                 'rwh'            => min(8, $actual['hours']),
    //                                 'is_early_leave' => 'N',
    //                                 'early_minutes'  => 0,
    //                                 'total_hours'    => $actual['totalHours'],
    //                             ]);
    //                             break;

    //                         case 3: // Absent → Present
    //                             $start = Carbon::parse($employee->start_punch)->addMinutes($random);
    //                             $end   = Carbon::parse($employee->end_punch)->addMinutes($random);

    //                             $actual = calculateActualHours($start, $end, $shift->break_start, $shift->break_end);

    //                             $employee->update([
    //                                 'start_punch'    => $start,
    //                                 'end_punch'      => $end,
    //                                 'rwh'            => min(8, $actual['hours']),
    //                                 'www'            => 8,
    //                                 'attn_type'      => 'PR',
    //                                 'is_late'        => 'N',
    //                                 'is_early_leave' => 'N',
    //                                 'late_minutes'   => 0,
    //                                 'early_minutes'  => 0,
    //                                 'total_hours'    => $actual['totalHours'],
    //                             ]);
    //                             break;

    //                         case 4: // Partial Hours Fix
    //                             $start = Carbon::parse($employee->start_punch);
    //                             $end   = Carbon::parse($employee->end_punch);

    //                             if ($employee->is_late === 'Y') $start->subMinutes($employee->late_minutes + $random);
    //                             if ($employee->is_early_leave === 'Y') $end->addMinutes($employee->early_minutes + $random);

    //                             $actual = calculateActualHours($start, $end, $shift->break_start, $shift->break_end);

    //                             $employee->update([
    //                                 'start_punch'    => $start,
    //                                 'end_punch'      => $end,
    //                                 'is_late'        => 'N',
    //                                 'is_early_leave' => 'N',
    //                                 'late_minutes'   => 0,
    //                                 'early_minutes'  => 0,
    //                                 'rwh'            => min(8, $actual['hours']),
    //                                 'www'            => 8,
    //                                 'short_minutes'  => 0,
    //                                 'total_hours'    => $actual['totalHours'],
    //                             ]);
    //                             break;
    //                     }

    //                     $totalUpdated++;
    //                 }
    //             });
    //         };

    //         if ($request->title == 1) {
    //             // Validation
    //             $rules = ['date' => 'nullable|date'];
    //             if ($request->all_line !== 'on') $rules['department_id'] = 'required|array|min:1';
    //             if ($request->all_category !== 'on') $rules['parent_department_id'] = 'required|array|min:1';
    //             $request->validate($rules);

    //             $date = Carbon::parse($request->date)->format('Y-m-d');

    //             $employeeQuery = ProcessAttendence::with([
    //                 'employee:id,department_id,employee_id,line,refrerence_shift',
    //                 'employee.designation:id,category_code'
    //             ])
    //                 ->where('org_id', $request->organization_id)
    //                 ->where('work_date', $date)
    //                 ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id))
    //                 ->when(!$request->employee_id, function ($q) use ($request) {
    //                     $q->whereHas('employee', function ($query) use ($request) {
    //                         if (!empty($request->department_id)) $query->whereIn('department_id', (array)$request->department_id);
    //                         if (!empty($request->category_id)) $query->whereHas('designation', fn($q2) => $q2->where('category_code', $request->category_id));
    //                         if (!empty($request->line)) $query->where('line', $request->line);
    //                     });
    //                 })
    //                 ->orderBy('employee_id')
    //                 ->orderBy('work_date');

    //             // Apply chunk
    //             switch ($request->adjust_type) {
    //                 case 1:
    //                     $employeeQuery->where('is_late', 'Y')->chunk(100, $adjustCallback);
    //                     break;
    //                 case 2:
    //                     $employeeQuery->where('is_early_leave', 'Y')->chunk(100, $adjustCallback);
    //                     break;
    //                 case 3:
    //                     $employeeQuery->where('attn_type', 'AB')->whereNotNull('start_punch')->where('start_punch', '!=', '0000-00-00 00:00:00')->chunk(100, $adjustCallback);
    //                     break;
    //                 case 4:
    //                     $employeeQuery->whereBetween('rwh', [1, 7.99])->chunk(100, $adjustCallback);
    //                     break;
    //             }

    //             $timeTaken = round(microtime(true) - $startTime, 2);

    //             return redirect()->back()->with('success', "Attendance adjustment completed. Total records updated: {$totalUpdated}. Time taken: {$timeTaken} sec.");
    //         } elseif ($request->title == 2) {
    //             // Month-wise
    //             $rules = [
    //                 'month' => 'required|integer|between:1,12',
    //                 'year'  => 'required|integer|min:2000',
    //             ];

    //             if ($request->all_line !== 'on') $rules['department_id'] = 'required|array|min:1';
    //             if ($request->all_category !== 'on') $rules['parent_department_id'] = 'required|array|min:1';
    //             $request->validate($rules);

    //             $monthStart = Carbon::createFromDate($request->year, $request->month, 1)->startOfMonth();
    //             $monthEnd   = $monthStart->copy()->endOfMonth();

    //             for ($date = $monthStart->copy(); $date->lte($monthEnd); $date->addDay()) {
    //                 $employeeQuery = ProcessAttendence::with([
    //                     'employee:id,department_id,employee_id,line,refrerence_shift',
    //                     'employee.designation:id,category_code'
    //                 ])
    //                     ->where('org_id', $request->organization_id)
    //                     ->where('work_date', $date->format('Y-m-d'))
    //                     ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id))
    //                     ->when(!$request->employee_id, function ($q) use ($request) {
    //                         $q->whereHas('employee', function ($query) use ($request) {
    //                             if (!empty($request->department_id)) $query->whereIn('department_id', (array)$request->department_id);
    //                             if (!empty($request->category_id)) $query->whereHas('designation', fn($q2) => $q2->where('category_code', $request->category_id));
    //                             if (!empty($request->line)) $query->where('line', $request->line);
    //                         });
    //                     })
    //                     ->orderBy('employee_id')
    //                     ->orderBy('work_date');

    //                 // Apply chunk
    //                 switch ($request->adjust_type) {
    //                     case 1:
    //                         $employeeQuery->where('is_late', 'Y')->chunk(100, $adjustCallback);
    //                         break;
    //                     case 2:
    //                         $employeeQuery->where('is_early_leave', 'Y')->chunk(100, $adjustCallback);
    //                         break;
    //                     case 3:
    //                         $employeeQuery->where('attn_type', 'AB')->whereNotNull('start_punch')->where('start_punch', '!=', '0000-00-00 00:00:00')->chunk(100, $adjustCallback);
    //                         break;
    //                     case 4:
    //                         $employeeQuery->whereBetween('rwh', [1, 7.99])->chunk(100, $adjustCallback);
    //                         break;
    //                 }
    //             }

    //             $timeTaken = round(microtime(true) - $startTime, 2);
    //             return redirect()->back()->with('success', "Monthly attendance adjustment completed. Total records updated: {$totalUpdated}. Time taken: {$timeTaken} sec.");
    //         }
    //     } catch (\Throwable $e) {
    //         return redirect()->back()->with('error', 'Attendance adjustment failed. ' . $e->getMessage());
    //     }
    // }

    public function store(AttendenceAdjustmentRequest $request)
    {
        try {
            $startTime = microtime(true);
            $totalUpdated = 0;

            // ------------------ Cache Shifts Globally ------------------
            $baseShifts = Shift::active()
                ->select('shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get()
                ->keyBy('shift');

            $companyShifts = CompanyWiseShift::active()
                ->where('org_id', $request->organization_id)
                ->select('shift', 'shift_start', 'shift_end', 'break_start', 'break_end', 'break_duration', 'break_duration_type', 'late_after_minutes')
                ->get()
                ->keyBy('shift');

            // ------------------ Adjust Callback ------------------
            $adjustCallback = function ($employees) use (&$totalUpdated, $request, $baseShifts, $companyShifts) {
                DB::transaction(function () use ($employees, &$totalUpdated, $request, $baseShifts, $companyShifts) {
                    foreach ($employees as $employee) {
                        $shift = $companyShifts[$employee->shift] ?? $baseShifts[$employee->shift] ?? null;
                        if (!$shift) continue;

                        $random = rand(0, 5);
                        $updateData = [];

                        // Calculate punches based on adjust type
                        if ($request->adjust_type == 1 && $employee->is_late === 'Y') { // Late
                            $start = Carbon::parse($employee->start_punch)->subMinutes($employee->late_minutes + $random);
                            $actual = calculateActualHours($start, $employee->end_punch, $shift->break_start, $shift->break_end);
                            $updateData = [
                                'start_punch'  => $start,
                                'rwh'          => min(8, $actual['hours']),
                                'is_late'      => 'N',
                                'late_minutes' => 0,
                                'total_hours'  => $actual['totalHours'],
                            ];
                        } elseif ($request->adjust_type == 2 && $employee->is_early_leave === 'Y') { // Early Leave
                            $end = Carbon::parse($employee->end_punch)->addMinutes($employee->early_minutes + $random);
                            $actual = calculateActualHours($employee->start_punch, $end, $shift->break_start, $shift->break_end);
                            $updateData = [
                                'end_punch'      => $end,
                                'rwh'            => min(8, $actual['hours']),
                                'is_early_leave' => 'N',
                                'early_minutes'  => 0,
                                'total_hours'    => $actual['totalHours'],
                            ];
                        } elseif ($request->adjust_type == 3 && $employee->attn_type == 'AB' && $employee->start_punch != '0000-00-00 00:00:00') { // Absent → Present
                            $start = Carbon::parse($shift->shift_start)->addMinutes($random);
                            $end = Carbon::parse($shift->shift_end)->addMinutes($random);
                            $actual = calculateActualHours($start, $end, $shift->break_start, $shift->break_end);
                            $updateData = [
                                'start_punch'    => $start,
                                'end_punch'      => $end,
                                'rwh'            => min(8, $actual['hours']),
                                'www'            => 8,
                                'attn_type'      => 'PR',
                                'is_late'        => 'N',
                                'is_early_leave' => 'N',
                                'late_minutes'   => 0,
                                'early_minutes'  => 0,
                                'total_hours'    => $actual['totalHours'],
                            ];
                        } elseif ($request->adjust_type == 4 && $employee->rwh >= 1 && $employee->rwh < 8) { // Partial Hours Fix
                            $start = Carbon::parse($employee->start_punch);
                            $end = Carbon::parse($employee->end_punch);
                            if ($employee->is_late === 'Y') $start->subMinutes($employee->late_minutes + $random);
                            if ($employee->is_early_leave === 'Y') $end->addMinutes($employee->early_minutes + $random);
                            $actual = calculateActualHours($start, $end, $shift->break_start, $shift->break_end);
                            $updateData = [
                                'start_punch'    => $start,
                                'end_punch'      => $end,
                                'is_late'        => 'N',
                                'is_early_leave' => 'N',
                                'late_minutes'   => 0,
                                'early_minutes'  => 0,
                                'rwh'            => min(8, $actual['hours']),
                                'www'            => 8,
                                'short_minutes'  => 0,
                                'total_hours'    => $actual['totalHours'],
                            ];
                        }

                        if (!empty($updateData)) {
                            $employee->update($updateData);
                            $totalUpdated++;
                        }
                    }
                });
            };

            // ------------------ Validation & Query ------------------
            if ($request->title == 1) {
                $rules = ['date' => 'nullable|date'];
                if ($request->all_line !== 'on') $rules['department_id'] = 'required|array|min:1';
                if ($request->all_category !== 'on') $rules['parent_department_id'] = 'required|array|min:1';
                $request->validate($rules);

                $dates = [Carbon::parse($request->date)->format('Y-m-d')]; // single date
            } else { // title == 2, Month-wise
                $rules = [
                    'month' => 'required|integer|between:1,12',
                    'year'  => 'required|integer|min:2000',
                ];
                if ($request->all_line !== 'on') $rules['department_id'] = 'required|array|min:1';
                if ($request->all_category !== 'on') $rules['parent_department_id'] = 'required|array|min:1';
                $request->validate($rules);

                $monthStart = Carbon::createFromDate($request->year, $request->month, 1)->startOfMonth();
                $monthEnd   = $monthStart->copy()->endOfMonth();
                $dates = [];
                for ($date = $monthStart->copy(); $date->lte($monthEnd); $date->addDay()) {
                    $dates[] = $date->format('Y-m-d');
                }
            }

            // ------------------ Loop over dates ------------------
            foreach ($dates as $workDate) {
                $employeeQuery = ProcessAttendence::with([
                    'employee:id,department_id,employee_id,line,refrerence_shift',
                    'employee.designation:id,category_code'
                ])
                    ->where('org_id', $request->organization_id)
                    ->where('work_date', $workDate)
                    ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id))
                    ->when(!$request->employee_id, function ($q) use ($request) {
                        $q->whereHas('employee', function ($query) use ($request) {
                            if (!empty($request->department_id)) $query->whereIn('department_id', (array)$request->department_id);
                            if (!empty($request->category_id)) $query->whereHas('designation', fn($q2) => $q2->where('category_code', $request->category_id));
                            if (!empty($request->line)) $query->where('line', $request->line);
                        });
                    })
                    ->orderBy('employee_id');

                // Apply chunk based on adjust_type
                switch ($request->adjust_type) {
                    case 1:
                        $employeeQuery->where('is_late', 'Y')->chunk(100, $adjustCallback);
                        break;
                    case 2:
                        $employeeQuery->where('is_early_leave', 'Y')->chunk(100, $adjustCallback);
                        break;
                    case 3:
                        $employeeQuery->where('attn_type', 'AB')->whereNotNull('start_punch')->where('start_punch', '!=', '0000-00-00 00:00:00')->chunk(100, $adjustCallback);
                        break;
                    case 4:
                        $employeeQuery->whereBetween('rwh', [1, 7.99])->chunk(100, $adjustCallback);
                        break;
                }
            }

            $timeTaken = round(microtime(true) - $startTime, 2);
            $message = $request->title == 1
                ? "Attendance adjustment completed. Total records updated: {$totalUpdated}. Time taken: {$timeTaken} sec."
                : "Monthly attendance adjustment completed. Total records updated: {$totalUpdated}. Time taken: {$timeTaken} sec.";

            return redirect()->back()->with('success', $message);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Attendance adjustment failed. ' . $e->getMessage());
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
    public function destroy($id) {}
}
