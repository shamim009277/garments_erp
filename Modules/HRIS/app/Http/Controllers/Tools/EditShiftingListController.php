<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ShiftingList;

class EditShiftingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate   = Carbon::now()->endOfMonth()->format('Y-m-d');
        $shifts    = ShiftingList::pluck('shift', 'shift')->unique()->toArray();

        return view('hris::tools.editshiftinglist.index', compact('startDate', 'endDate', 'shifts'));
    }

    public function create()
    {
        return view('hris::create');
    }

    public function store(Request $request)
    {
        if ($request->form == 1) {
            $date = Carbon::parse($request->date);
            $shiftingLists = ShiftingList::with('employeeBasic')
                ->where('date', $date)
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $shiftingLists,
            ]);
        } elseif ($request->form == 2) {
            $shiftingLists = ShiftingList::with('employeeBasic')
                ->where('employee_id', (int) $request->emp_id)
                ->whereBetween('date', [$request->start_date, $request->end_date])
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $shiftingLists,
            ]);
        } elseif ($request->form == 3) {
            $employee = Employee::active()
                ->where('employee_id', (int) $request->emp_id)
                ->select('employee_id','org_id','name', 'joining_date','shifting_duty', 'refrerence_shift')
                ->first();

            ShiftingList::where('employee_id',$request->emp_id)->whereBetween('date',[$request->start_date,$request->end_date])->delete();
            $lastid = DB::table('hris_tools_shifting_list')->orderBy('id','DESC')->first();
            $lastid = $lastid ? $lastid->id+1 : 1;
            DB::update("ALTER TABLE hris_tools_shifting_list AUTO_INCREMENT = ".$lastid.";");

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found',
                ]);
            }

            $date = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $year = $date->year;

            $rows = [];

            if ($employee->shifting_duty === 'Y') {
                if (!empty($request->shift) && !empty($request->to_shift)) {
                    $i = 1;
                    $shift2 = '';

                    while ($date->lte($endDate)) {
                        if ($i === 1) {
                            $shift2 = $request->shift;
                        } else {
                            if ($request->holiday && date('l', strtotime($date)) === $request->holiday) {
                                if ($shift2 === $request->shift) {
                                    $shift2 = $request->to_shift;
                                }
                            }
                        }

                        $rows[] = [
                            'year'        => (int) $year,
                            'employee_id' => $employee->employee_id,
                            'org_id'      => (int)$employee->org_id,
                            'date'        => $date->format('Y-m-d'),
                            'shift'       => $shift2,
                            'created_by'  => Auth::id(),
                            'updated_by'  => Auth::id(),
                        ];

                        $date->addDay();
                        $i++;
                    }

                    ShiftingList::insert($rows);
                }
            } else {
                while ($date->lte($endDate)) {
                    $rows[] = [
                        'employee_id' => (int)$employee->employee_id,
                        'year'        => (int) $year,
                        'org_id'      => (int)$employee->org_id,
                        'date'        => $date->format('Y-m-d'),
                        'shift'       => $request->shift,
                        'created_by'  => Auth::id(),
                        'updated_by'  => Auth::id(),
                    ];
                    $date->addDay();
                }
                ShiftingList::insert($rows);
            }

            $shiftingLists = ShiftingList::with('employeeBasic')
                    ->where('employee_id', (int) $request->emp_id)
                    ->whereBetween('date', [$request->start_date, $request->end_date])
                    ->get();

            return response()->json([
                'success' => true,
                'message' => 'Shifting list saved successfully',
                'data'    => $shiftingLists,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid form type',
        ]);
    }

    public function show($id)
    {
        return view('hris::show');
    }

    public function edit($id)
    {
        return view('hris::edit');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'form'  => 'required',
            'shift' => 'required|exists:hris_setup_shifts,shift',
        ]);

        try {
            if ($request->form == 1) {
                $shiftingList = ShiftingList::find($id);

                if (!$shiftingList) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Shift record not found',
                    ]);
                }

                $shiftingList->shift = $request->shift;
                $shiftingList->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Shift updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        // implement if needed
    }
}
