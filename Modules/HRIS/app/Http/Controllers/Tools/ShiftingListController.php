<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Http\Requests\Tools\ShiftingListRequest;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Tools\ShiftingList;

class ShiftingListController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.shifting-list.view')->only('index');
        $this->middleware('permission:hris.shifting-list.add')->only('store');
        $this->middleware('permission:hris.shifting-list.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.shifting-list.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $organizations = Organization::active()->pluck('short_name', 'id');
        return view('hris::tools.shiftinglist.index', compact('parentDepartments', 'organizations'));
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
    // public function store(ShiftingListRequest $request) {
    //     try {
    //         $startTime = microtime(true);
    //         $totalInserted = 0;

    //         date_default_timezone_set('Asia/Dhaka');
    //         $year = $request->year;
    //         $start_date = Carbon::createFromDate($year, 1, 1);
    //         $end_date   = Carbon::createFromDate($year, 12, 31);

    //         $employees = Employee::active()->whereIn('department_id', $request->department_id)->when($request->filled('organization_id'), function ($q) use ($request) {
    //                     $q->where('org_id', $request->organization_id);
    //                 })->get();

    //         $shifting_duty = ShiftingList::where('year', $year)->when($request->filled('organization_id'), function ($q) use ($request) {
    //                     $q->where('org_id', $request->organization_id);
    //                 })->get();

    //         if ($shifting_duty->isNotEmpty()) {
    //             return redirect()->back()->with('error', 'Shifting list for this year already exists.');
    //         } else {
    //             //Regular Employee
    //             $regular_employee = $employees->filter(fn($employee) => $employee->shifting_duty == 'N');
    //             $chunks = $regular_employee->chunk(20);

    //             foreach($chunks as $datas){
    //                 $rows = [];
    //                 foreach($datas as $employee){
    //                     $employeeJoining = Carbon::parse($employee->joining_date);
    //                     $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;

    //                     $date = $empStartDate->copy();
    //                     while ($date->lte($end_date)) {
    //                         $rows[] = [
    //                             'year'           => (int) $year,
    //                             'employee_id'    => (int)$employee->employee_id,
    //                             'org_id'         => (int)$employee->org_id,
    //                             'date'           => $date->format('Y-m-d'),
    //                             'shift'          => $employee->refrerence_shift,
    //                             'created_by'     => Auth::id(),
    //                             'updated_by'     => Auth::id(),
    //                         ];
    //                         $date->addDay();
    //                     }
    //                 }
    //                 $totalInserted += count($rows);
    //                 ShiftingList::insert($rows);
    //             }

    //             //Shift Employee
    //             $shift_employee = $employees->filter(fn($employee) => $employee->shifting_duty == 'Y');
    //             $empid = $shift_employee->pluck('employee_id')->toArray();
    //             $shiftdatas = ShiftingList::whereIn('employee_id', $empid)->when($request->filled('organization_id'), function ($q) use ($request) {
    //                         $q->where('org_id', $request->organization_id);
    //                     })->where('year', $year-1)->get();

    //             $chunks = $shift_employee->chunk(20);

    //             foreach($chunks as $datas){
    //                 $rows = [];
    //                 foreach($datas as $employee){
    //                     $employeeJoining = Carbon::parse($employee->joining_date);
    //                     $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;
    //                     $changeday = Carbon::parse($employee->refrerence_holiday)->addDay()->format('l');
    //                     $shift2 = ''; $i = 0;

    //                     $date = $empStartDate->copy();
    //                     while ($date->lte($end_date)) {
    //                         if($i == 0){
    //                             $shift = $shiftdatas->where('employee_id', $employee->employee_id)->first();
    //                             if($shift){
    //                                 if(date('l', strtotime($date)) == $changeday){
    //                                     if($shift->shift == 'A') {
    //                                         $shift2 = 'C';
    //                                     }elseif ($shift->shift == 'C') {
    //                                         $shift2 = 'B';
    //                                     }elseif ($shift->shift == 'B') {
    //                                         $shift2 = 'A';
    //                                     }elseif ($shift->shift == 'M') {
    //                                         $shift2 = 'N';
    //                                     }elseif ($shift->shift == 'N') {
    //                                         $shift2 = 'M';
    //                                     }else{
    //                                         $shift2 = $shift->shift;
    //                                     }
    //                                 }else{
    //                                     $shift2 = $shift->shift;
    //                                 }
    //                             }else{
    //                                 $shift2 = $employee->refrerence_shift;
    //                             }
    //                         }else{
    //                             if($date->format('l') == $changeday){
    //                                 $shift = $shift2;
    //                                 if($shift == 'A') {
    //                                     $shift2 = 'C';
    //                                 }elseif ($shift == 'C') {
    //                                     $shift2 = 'B';
    //                                 }elseif ($shift == 'B') {
    //                                     $shift2 = 'A';
    //                                 }elseif ($shift == 'M') {
    //                                     $shift2 = 'N';
    //                                 }elseif ($shift == 'N') {
    //                                     $shift2 = 'M';
    //                                 }else{
    //                                     $shift2 = $shift;
    //                                 }
    //                             }
    //                         }
    //                         $rows[] = [
    //                             'year'           => (int) $year,
    //                             'employee_id'    => (int)$employee->employee_id,
    //                             'org_id'         => (int)$employee->org_id,
    //                             'date'           => $date->format('Y-m-d'),
    //                             'shift'          => $shift2,
    //                             'created_by'     => Auth::id(),
    //                             'updated_by'     => Auth::id(),
    //                         ];
    //                         $date->addDay();
    //                         $i++;
    //                     }
    //                 }
    //                 $totalInserted += count($rows);
    //                 ShiftingList::insert($rows);
    //             }

    //             $endTime = microtime(true);
    //             $executionTime = round($endTime - $startTime, 2);
    //             $message = "Shifting list generated successfully. " ."Total inserted: " . $totalInserted . " rows. " ."Time taken: " . $executionTime . " seconds.";

    //             return redirect()->back()->with('success', $message);
    //         }
    //     } catch (\Throwable $th) {
    //        return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }
    public function store(ShiftingListRequest $request)
    {
        try {
            $startTime = microtime(true);
            date_default_timezone_set('Asia/Dhaka');

            $year = (int) $request->year;
            $start_date = Carbon::createFromDate($year, 1, 1);
            $end_date   = Carbon::createFromDate($year, 12, 31);

            // 🔍 Already exists check (fast)
            $exists = ShiftingList::where('year', $year)
                ->when($request->filled('organization_id'), fn($q) => $q->where('org_id', $request->organization_id))
                ->exists();

            if ($exists) {
                return back()->with('error', 'Shifting list for this year already exists.');
            }

            // 👥 Load employees
            $employees = Employee::active()
                ->whereIn('department_id', $request->department_id)
                ->when($request->filled('organization_id'), fn($q) => $q->where('org_id', $request->organization_id))
                ->get();

            $totalInserted = 0;

            DB::transaction(function () use (
                $employees, $year, $start_date, $end_date, $request, &$totalInserted
            ) {

                $regulars = $employees->where('shifting_duty', 'N');

                foreach ($regulars as $employee) {

                    $rows = [];

                    $employeeJoining = Carbon::parse($employee->joining_date);
                    $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;

                    $date = $empStartDate->copy();

                    while ($date->lte($end_date)) {
                        $rows[] = [
                            'year' => $year,
                            'employee_id' => $employee->employee_id,
                            'org_id' => $employee->org_id,
                            'date' => $date->format('Y-m-d'),
                            'shift' => $employee->refrerence_shift,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                        ];
                        $date->addDay();
                    }

                    foreach (array_chunk($rows, 500) as $batch) {
                        ShiftingList::insert($batch);
                    }

                    $totalInserted += count($rows);
                }

                /* ================= SHIFT EMPLOYEE ================= */

                $shiftEmployees = $employees->where('shifting_duty', 'Y');

                $previousShifts = ShiftingList::whereIn(
                        'employee_id',
                        $shiftEmployees->pluck('employee_id')
                    )
                    ->when($request->filled('organization_id'), fn($q) => $q->where('org_id', $request->organization_id))
                    ->where('year', $year - 1)
                    ->get()
                    ->keyBy('employee_id');

                foreach ($shiftEmployees as $employee) {

                    $rows = [];

                    $employeeJoining = Carbon::parse($employee->joining_date);
                    $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;

                    $changeday = Carbon::parse($employee->refrerence_holiday)->addDay()->format('l');

                    $prevShift = $previousShifts[$employee->employee_id]->shift ?? $employee->refrerence_shift;

                    $shift2 = $prevShift;
                    $date = $empStartDate->copy();

                    while ($date->lte($end_date)) {

                        if ($date->format('l') === $changeday) {
                            $shift2 = match ($shift2) {
                                'A' => 'C',
                                'C' => 'B',
                                'B' => 'A',
                                'M' => 'N',
                                'N' => 'M',
                                default => $shift2,
                            };
                        }

                        $rows[] = [
                            'year' => $year,
                            'employee_id' => $employee->employee_id,
                            'org_id' => $employee->org_id,
                            'date' => $date->format('Y-m-d'),
                            'shift' => $shift2,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                        ];

                        $date->addDay();
                    }

                    foreach (array_chunk($rows, 500) as $batch) {
                        ShiftingList::insert($batch);
                    }

                    $totalInserted += count($rows);
                }
            });

            $executionTime = round(microtime(true) - $startTime, 2);

            return back()->with(
                'success',
                "Shifting list generated successfully. Total inserted: {$totalInserted} rows. Time: {$executionTime}s"
            );

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
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
}
