<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Tools\Calender;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Models\Tools\PunchData;
use Illuminate\Support\Facades\DB;

class EditAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        return view('payroll::tools.edit-attendence.index', compact('organizations'));
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
    public function store(Request $request)
    {
        if ($request->form == 1) {
            $request->validate([
                'employee_id' => 'required',
                'organization_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $startDate = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');

            $attendence = ProcessAttendence::where('employee_id', $request->employee_id)
                ->where('org_id', $request->organization_id)
                ->whereBetween('work_date', [$startDate, $endDate])
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $attendence,
            ]);
        } else if ($request->form == 2) {
            $request->validate([
                'employee_id' => 'required',
                'organization_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate   = Carbon::parse($request->end_date)->startOfDay();
            $employee = Employee::select('id', 'refrerence_shift')->findOrFail($request->employee_id);
            $defaultShift = $employee->refrerence_shift;

            $calender = Calender::whereBetween('date', [
                $startDate->toDateString(),
                $endDate->toDateString()
            ])
                ->get()
                ->keyBy(function ($item) {
                    return Carbon::parse($item->date)->format('Y-m-d');
                });

            $shiftingList = ShiftingList::where('employee_id', $request->employee_id)
                ->where('org_id', $request->organization_id)
                ->whereBetween('date', [
                    $startDate->toDateString(),
                    $endDate->toDateString()
                ])
                ->get()
                ->keyBy(function ($item) {
                    return Carbon::parse($item->date)->format('Y-m-d');
                });

            $period = CarbonPeriod::create(
                $startDate->toDateString(),
                $endDate->toDateString()
            );

            $existingAttenDates = ProcessAttendence::where('employee_id', $request->employee_id)
                ->where('org_id', $request->organization_id)
                ->whereBetween('work_date', [
                    $startDate->toDateString(),
                    $endDate->toDateString()
                ])
                ->pluck('work_date')
                ->toArray();

            $shiftingData = Shift::active()->get()->keyBy('shift');

            $data = [];

            foreach ($period as $date) {
                $workDate = $date->format('Y-m-d');
                //SKIP if already exists
                if (in_array($workDate, $existingAttenDates)) {
                    continue;
                }
                $cal = $calender[$workDate] ?? null;

                $shift = $shiftingList[$workDate]->shift ?? $defaultShift;
                $shiftData = $shiftingData[$shift] ?? null;

                if ($shiftData) {
                    $startPunch = $workDate . ' ' . $shiftData->shift_start;
                    $endPunch   = $workDate . ' ' . $shiftData->shift_end;
                } else {
                    $startPunch = $workDate . ' 00:00:00';
                    $endPunch   = $workDate . ' 00:00:00';
                }

                $isHoliday = $cal?->holiday == 'Y';
                $isPublicHoliday = $cal?->public_holiday == 'Y';
                $rwh = 8;
                $attnType = 'PR';

                if ($isHoliday || $isPublicHoliday) {
                    $startPunch = '0000-00-00 00:00';
                    $endPunch   = '0000-00-00 00:00';
                    $rwh = 0;
                    $attnType = 'HD';
                }

                $data[] = [
                    'employee_id'     => $request->employee_id,
                    'organization_id' => $request->organization_id,
                    'shift'           => $shift,
                    'work_date'       => $workDate,
                    'start_punch'     => $startPunch,
                    'end_punch'       => $endPunch,
                    'rwh'             => $rwh,
                    'ot_hours'        => 0,
                    'is_late'         => 'N',
                    'attn_type'       => $attnType,
                ];
            }

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'start_punch' => 'nullable|string|max:255',
            'end_punch' => 'nullable|string|max:50',
            'rwh' => 'nullable|string|max:50',
            'ot_hours' => 'nullable|integer',
            'is_late' => 'nullable|string|max:50',
            'attn_type' => 'nullable|string|max:50',
        ]);

        try {
            foreach (['start_punch', 'end_punch'] as $field) {
                if (isset($validated[$field]) && $validated[$field] === '0000-00-00 00:00') {
                    $validated[$field] = null;
                }
            }

            $attendence = ProcessAttendence::findOrFail($id);
            $attendence->fill($validated);
            $attendence->save();

            return response()->json([
                'success' => true,
                'message' => 'Attendence updated successfully',
                'data' => $attendence
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update attendence: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    /**
     * Store a newly created resource in storage.
     */
    public function manualStore(Request $request)
    {
        $validated = $request->validate([
            'rows' => 'required|array|min:1',
            'rows.*.employee_id'     => 'required|exists:hris_database_employee_basic,id',
            'rows.*.organization_id' => 'required|exists:hris_setup_organizations,id',
            'rows.*.shift'           => 'required|string|max:10',
            'rows.*.work_date'       => 'required|date',
            'rows.*.start_punch'     => 'nullable|string|max:255',
            'rows.*.end_punch'       => 'nullable|string|max:255',
            'rows.*.rwh'             => 'nullable|numeric|min:0',
            'rows.*.ot_hours'        => 'nullable|numeric|min:0',
            'rows.*.is_late'         => 'required|in:Y,N',
            'rows.*.attn_type'       => 'required|in:PR,HD,AB,CL,SL,EL',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->rows as $row) {
                $start = $row['start_punch'] ?? null;
                $end   = $row['end_punch'] ?? null;

                if ($start === '0000-00-00 00:00') $start = null;
                if ($end === '0000-00-00 00:00') $end = null;

                // 🔥 CHECK EXISTING RECORD
                $existing = ProcessAttendence::where('employee_id', $row['employee_id'])
                    ->where('org_id', $row['organization_id'])
                    ->where('work_date', $row['work_date'])
                    ->first();

                if ($existing) {
                    $existing->update([
                        'shift' => $row['shift'],
                        'start_punch' => $start,
                        'end_punch' => $end,
                        'rwh' => $row['rwh'],
                        'ot_hours' => $row['ot_hours'],
                        'is_late' => $row['is_late'],
                        'attn_type' => $row['attn_type'],
                        'updated_by' => auth()->id(),
                        'updated_at' => now(),
                    ]);
                } else {
                    ProcessAttendence::create([
                        'employee_id' => $row['employee_id'],
                        'org_id' => $row['organization_id'],
                        'work_date' => $row['work_date'],
                        'shift' => $row['shift'],
                        'start_punch' => $start,
                        'end_punch' => $end,
                        'rwh' => $row['rwh'],
                        'wwh' => 8,
                        'ot_hours' => $row['ot_hours'],
                        'total_hours' => $row['ot_hours'],
                        'is_late' => $row['is_late'],
                        'attn_type' => $row['attn_type'],
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Attendence data saved successfully (check + insert/update)',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
