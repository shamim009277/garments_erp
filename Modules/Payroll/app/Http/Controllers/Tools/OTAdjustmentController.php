<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\Setup\CompanyWiseShift;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\Payroll\Models\Tools\ProcessAttendence;

class OTAdjustmentController extends Controller
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
        $parentDepartments = ParentDepartment::with('departments')
            ->whereHas('departments', function ($q) use ($departmentIds) {
                $q->whereIn('id', $departmentIds);
            })
            ->orderBy('department', 'asc')
            ->get();
        $employeeCategories = EmployeeCategory::pluck('category', 'category_code')->toArray();
        $types = ['1' => 'Increase OT', '2' => 'Decrease OT'];

        return view('payroll::tools.otadjustment.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'employeeCategories', 'types'));
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
    // public function store(Request $request) {
    //     $request->validate([
    //         'title' => 'required',
    //         'organization_id' => 'required|integer|min:1',
    //         'adjust_type' => 'required|integer|min:1',
    //         'amount_hour' => 'required|numeric|min:1',
    //         'date' => 'required|date',
    //     ]);

    //     if($request->title == 1){
    //         $request->validate([
    //             'department_id' => 'required|array|min:1',
    //         ]);

    //         $departmentIds = $request->department_id;
    //         $date = Carbon::parse($request->date)->format('Y-m-d');
    //         $hour = $request->amount_hour;

    //         $employees = Employee::active()
    //             ->where('org_id', $request->organization_id)
    //             ->where('ot_payable', 'Y')
    //             ->whereIn('department_id', $departmentIds)
    //             ->when($request->filled('line'), function ($q) use ($request) {
    //                 $q->where('line', $request->line);
    //             })
    //             ->get();

    //         $employeeids = $employees->pluck('employee_id')->toArray();
    //         $attendences = ProcessAttendence::whereIn('employee_id', $employeeids)
    //             ->where('work_date', $date)
    //             ->get();

    //         if($request->adjust_type == 1){
    //             $attendences = $attendences->where('attn_type', 'PR');

    //             $chunds = $attendences->chunk(100);
    //             foreach ($chunds as $chund) {
    //                 foreach ($chund as $attendence) {
    //                     if (($attendence->ot_hours + $hour) < 12) {
    //                         $companyshift = CompanyWiseShift::active()
    //                             ->where('org_id', $request->organization_id)
    //                             ->where('shift', $attendence->shift)
    //                             ->select(
    //                                 'org_id','shift','shift_start','shift_end',
    //                                 'break_duration','break_duration_type','late_after_minutes'
    //                             )->first();

    //                         $baseshift = Shift::active()
    //                             ->where('shift', $attendence->shift)
    //                             ->select(
    //                                 'shift','shift_start','shift_end',
    //                                 'break_duration','break_duration_type','late_after_minutes'
    //                             )
    //                             ->first();

    //                         $shift = $companyshift ?? $baseshift;
    //                         if (!$shift || !$shift->shift_start || !$shift->shift_end) {
    //                             return redirect()->back()->with('error', 'Shift timing not found for this employee');
    //                         }

    //                         $shiftEnd = Carbon::parse($date . ' ' . $shift->shift_end);
    //                         $empEndShift = Carbon::parse($attendence->end_punch);

    //                         if ($empEndShift->greaterThan($shiftEnd)) {
    //                             $attendence->end_punch = $empEndShift->addHours($hour);
    //                         } else {
    //                             $attendence->end_punch = $shiftEnd->copy()->addHours($hour)->addMinutes(random_int(1, 10));
    //                         }
    //                         $attendence->ot_hours += $hour;
    //                         $attendence->save();
    //                     }
    //                 }
    //             }
    //         }else if($request->adjust_type == 2){
    //             $attendences = $attendences->where('ot_hours', '>=', $hour);

    //             $chunds = $attendences->chunk(100);
    //             foreach ($chunds as $chund) {
    //                 foreach ($chund as $attendence) {
    //                     $attendence->end_punch = Carbon::parse($attendence->end_punch)->subHours($hour);
    //                     $attendence->ot_hours -= $hour;
    //                     $attendence->save();
    //                 }
    //             }
    //         }
    //         return redirect()->back()->with('success', 'OT Adjustment done successfully');
    //     }else if ($request->title == 2) {
    //         $request->validate([
    //             'employee_id' => 'required',
    //         ]);

    //         $date = Carbon::parse($request->date)->format('Y-m-d');

    //         $employee = Employee::where('employee_id', (int)$request->employee_id)->first();
    //         if (!$employee) {
    //             return redirect()->back()->with('error', 'Employee not found');
    //         }

    //         $attendence = ProcessAttendence::where('employee_id', (int)$request->employee_id)
    //             ->where('work_date', $date)
    //             ->where('attn_type', 'PR')
    //             ->first();

    //         if (!$attendence) {
    //             return redirect()->back()->with('error', 'Attendance not found for this employee');
    //         }

    //         $otHours = (int)$request->amount_hour;

    //         if ($request->adjust_type == 1) {
    //             if (($attendence->ot_hours + $otHours) > 12) {
    //                 return redirect()->back()->with('error', 'Total OT Hours cannot exceed 12');
    //             }
    //             $companyshift = CompanyWiseShift::active()
    //                 ->where('org_id', $request->organization_id)
    //                 ->where('shift', $attendence->shift)
    //                 ->select(
    //                     'org_id','shift','shift_start','shift_end',
    //                     'break_duration','break_duration_type','late_after_minutes'
    //                 )
    //                 ->first();
    //             $baseshift = Shift::active()
    //                 ->where('shift', $attendence->shift)
    //                 ->select(
    //                     'shift','shift_start','shift_end',
    //                     'break_duration','break_duration_type','late_after_minutes'
    //                 )
    //                 ->first();

    //             $shift = $companyshift ?? $baseshift;
    //             if (!$shift || !$shift->shift_start || !$shift->shift_end) {
    //                 return redirect()->back()->with('error', 'Shift timing not found for this employee');
    //             }

    //             $shiftEnd = Carbon::parse($date . ' ' . $shift->shift_end);
    //             $empEndShift = Carbon::parse($attendence->end_punch);

    //             if ($empEndShift->greaterThan($shiftEnd)) {
    //                 $attendence->end_punch = $empEndShift->addHours($otHours);
    //             } else {
    //                 $attendence->end_punch = $shiftEnd->copy()->addHours($otHours)->addMinutes(random_int(1, 10));
    //             }
    //             $attendence->ot_hours += $otHours;
    //             $attendence->save();
    //             return redirect()->back()->with('success', 'OT Adjustment done successfully');
    //         } else if ($request->adjust_type == 2) {
    //             if ($attendence->ot_hours < $otHours) {
    //                 return redirect()->back()->with('error', 'OT Hours is less than OT Adjustment');
    //             }
    //             if (($attendence->ot_hours + $otHours) > 12) {
    //                 return redirect()->back()->with('error', 'Total OT Hours is more than 12');
    //             }
    //             $attendence->end_punch = Carbon::parse($attendence->end_punch)->subHours($otHours);
    //             $attendence->ot_hours -= $otHours;
    //             $attendence->save();
    //             return redirect()->back()->with('success', 'OT Adjustment done successfully');
    //         }
    //     }else{
    //         return redirect()->back()->with('error', 'Invalid title');
    //     }
    // }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'organization_id' => 'required|integer|min:1',
            'adjust_type' => 'required|integer|min:1',
            'amount_hour' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $hour = (float) $request->amount_hour;

        DB::beginTransaction();

        try {
            if ($request->title == 1) {
                $request->validate([
                    'department_id' => 'required|array|min:1',
                ]);

                $employeeIds = Employee::active()
                    ->where('org_id', $request->organization_id)
                    ->where('ot_payable', 'Y')
                    ->whereIn('department_id', $request->department_id)
                    ->when($request->filled('line'), fn ($q) => $q->where('line', $request->line))
                    ->pluck('employee_id')
                    ->toArray();

                if (empty($employeeIds)) {
                    throw new \Exception('No employees found for given criteria');
                }

                /* 🔹 Shift Cache */
                $companyShifts = CompanyWiseShift::active()
                    ->where('org_id', $request->organization_id)
                    ->get()
                    ->keyBy('shift');

                $baseShifts = Shift::active()
                    ->get()
                    ->keyBy('shift');

                $attendences = ProcessAttendence::whereIn('employee_id', $employeeIds)
                    ->where('work_date', $date)
                    ->when($request->adjust_type == 1, fn ($q) => $q->where('attn_type', 'PR'))
                    ->when($request->adjust_type == 2, fn ($q) => $q->where('ot_hours', '>=', $hour))
                    ->get();

                if ($attendences->isEmpty()) {
                    throw new \Exception('No attendance data found');
                }

                /* 🔹 ADD OT */
                if ($request->adjust_type == 1) {

                    foreach ($attendences->chunk(100) as $chunk) {
                        foreach ($chunk as $attendence) {

                            if (($attendence->ot_hours + $hour) > 12) {
                                continue;
                            }

                            $shift = $companyShifts[$attendence->shift]
                                ?? $baseShifts[$attendence->shift]
                                ?? null;

                            if (!$shift || !$shift->shift_start || !$shift->shift_end) {
                                throw new \Exception(
                                    "Shift timing not found for employee ID: {$attendence->employee_id}"
                                );
                            }

                            $shiftEnd = Carbon::parse($date . ' ' . $shift->shift_end);
                            $empEndShift = Carbon::parse($attendence->end_punch);

                            if ($empEndShift->greaterThan($shiftEnd)) {
                                $attendence->end_punch = $empEndShift->addHours($hour);
                            } else {
                                $attendence->end_punch = $shiftEnd->copy()
                                    ->addHours($hour)
                                    ->addMinutes(random_int(1, 10));
                            }

                            $attendence->ot_hours += $hour;
                            $attendence->save();
                        }
                    }
                }

                /* 🔹 SUBTRACT OT */
                if ($request->adjust_type == 2) {
                    foreach ($attendences->chunk(100) as $chunk) {
                        foreach ($chunk as $attendence) {
                            $attendence->end_punch = Carbon::parse($attendence->end_punch)->subHours($hour);
                            $attendence->ot_hours -= $hour;
                            $attendence->save();
                        }
                    }
                }
            }elseif ($request->title == 2) {
                $request->validate([
                    'employee_id' => 'required',
                ]);
                $attendence = ProcessAttendence::where('employee_id', (int) $request->employee_id)->where('work_date', $date)->where('attn_type', 'PR')->first();

                if (!$attendence) {
                    throw new \Exception('Attendance not found for this employee');
                }

                $companyShift = CompanyWiseShift::active()->where('org_id', $request->organization_id)->where('shift', $attendence->shift)->first();
                $baseShift = Shift::active()->where('shift', $attendence->shift)->first();
                $shift = $companyShift ?? $baseShift;

                if (!$shift || !$shift->shift_start || !$shift->shift_end) {
                    throw new \Exception('Shift timing not found');
                }

                /* 🔹 ADD OT */
                if ($request->adjust_type == 1) {
                    if (($attendence->ot_hours + $hour) > 12) {
                        throw new \Exception('Total OT Hours cannot exceed 12');
                    }

                    $shiftEnd = Carbon::parse($date . ' ' . $shift->shift_end);
                    $empEndShift = Carbon::parse($attendence->end_punch);

                    if ($empEndShift->greaterThan($shiftEnd)) {
                        $attendence->end_punch = $empEndShift->addHours($hour);
                    } else {
                        $attendence->end_punch = $shiftEnd->copy()
                            ->addHours($hour)
                            ->addMinutes(random_int(1, 10));
                    }

                    $attendence->ot_hours += $hour;
                    $attendence->save();
                }

                /* 🔹 SUBTRACT OT */
                if ($request->adjust_type == 2) {
                    if ($attendence->ot_hours < $hour) {
                        throw new \Exception('OT Hours is less than adjustment');
                    }
                    $attendence->end_punch = Carbon::parse($attendence->end_punch)->subHours($hour);
                    $attendence->ot_hours -= $hour;
                    $attendence->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'OT Adjustment done successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Process failed. ' . $e->getMessage());
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
