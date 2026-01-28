<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Http\Requests\Tools\ExceptionalHolidayRequest;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;

class ExceptionalHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::active()->pluck('short_name', 'id');
        return view('hris::tools.exceptionalholiday.index', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(ExceptionalHolidayRequest $request)
    // {
    //     if ($request->action == 'generate') {
    //         date_default_timezone_set('Asia/Dhaka');
    //         $year = $request->year;
    //         $start_date = Carbon::createFromDate($year, 1, 1);
    //         $end_date   = Carbon::createFromDate($year, 12, 31);

    //         $employees = Employee::active()->shiftingDuty()->select('id', 'employee_id', 'refrerence_holiday', 'joining_date')->get();
    //         $exceptional_holidays = ExceptionalHoliday::where('year', $year)->where('org_id', $request->organization_id)->get();

    //         if ($exceptional_holidays->isNotEmpty()) {
    //             return redirect()->back()->with('error', 'Exceptional holidays for this year already exists.');
    //         } else {
    //             $chunks = $employees->chunk(200);

    //             foreach ($chunks as $datas) {
    //                 $rows = [];
    //                 foreach ($datas as $employee) {
    //                     $employeeJoining = Carbon::parse($employee->joining_date);
    //                     $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;

    //                     $date = $empStartDate->copy();
    //                     while ($date->lte($end_date)) {
    //                         if ($employee->refrerence_holiday == date('l', strtotime($date))) {
    //                             $rows[] = [
    //                                 'year'           => (int) $year,
    //                                 'org_id'         => $request->organization_id,
    //                                 'employee_id'    => $employee->employee_id,
    //                                 'holiday_date'   => $date->format('Y-m-d'),
    //                                 'created_by'     => Auth::id(),
    //                                 'updated_by'     => Auth::id(),
    //                             ];
    //                         }
    //                         $date->addDay();
    //                     }
    //                 }
    //                 ExceptionalHoliday::insert($rows);
    //             }
    //             return redirect()->back()->with('success', 'Exceptional holidays generated successfully.');
    //         }
    //     } elseif ($request->action == 'generate_for_new') {
    //         date_default_timezone_set('Asia/Dhaka');
    //         $year = $request->year;
    //         $end_date   = Carbon::createFromDate($year, 12, 31); 

    //         $employees = Employee::active()->shiftingDuty()->select('id', 'employee_id', 'refrerence_holiday', 'joining_date')->get();
    //         $employeeids = $employees->pluck('employee_id')->toArray();

    //         $exceptional_holidays = ExceptionalHoliday::where('year', $year)->where('org_id', $request->organization_id)->get();
    //         $existingids = $exceptional_holidays->pluck('employee_id')->toArray();

    //         $newEmployeeIds = array_diff($employeeids, $existingids);
    //         if (empty($newEmployeeIds)) {
    //             return redirect()->back()->with('error', 'Exceptional holidays list already generated for this year.');
    //         }

    //         $generatingEmployees = $employees->whereIn('employee_id', $newEmployeeIds);

    //         if ($generatingEmployees->isNotEmpty()) {
    //             $chunks = $generatingEmployees->chunk(100);
    //             foreach ($chunks as $datas) {
    //                 $rows = [];
    //                 foreach ($datas as $employee) {
    //                     $employeeJoining = Carbon::parse($employee->joining_date);
    //                     $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;
    //                     $date = $empStartDate->copy();
    //                     while ($date->lte($end_date)) {
    //                         if ($employee->refrerence_holiday == date('l', strtotime($date))) {
    //                             $rows[] = [
    //                                 'year'           => (int) $year,
    //                                 'org_id'         => $request->organization_id,
    //                                 'employee_id'    => $employee->employee_id,
    //                                 'holiday_date'   => $date->format('Y-m-d'),
    //                                 'created_by'     => Auth::id(),
    //                                 'updated_by'     => Auth::id(),
    //                             ];
    //                         }
    //                         $date->addDay();
    //                     }
    //                 }
    //                 ExceptionalHoliday::insert($rows);
    //             }
    //             return redirect()->back()->with('success', 'Exceptional holidays generated successfully.');
    //         }else{
    //             return redirect()->back()->with('error', 'Exceptional holidays list already generated for this year.');
    //         }
    //     }
    // }

    public function store(ExceptionalHolidayRequest $request)
    {
        try {
            date_default_timezone_set('Asia/Dhaka');

            $year = $request->year;
            $start_date = Carbon::createFromDate($year, 1, 1);
            $end_date   = Carbon::createFromDate($year, 12, 31);

            $action = $request->action;
            $employeesQuery = Employee::active()->shiftingDuty()->select('id', 'employee_id', 'refrerence_holiday', 'joining_date','leaving_date','reason');
            $existingHolidays = ExceptionalHoliday::where('year', $year)
                ->where('org_id', $request->organization_id)
                ->pluck('employee_id')
                ->toArray();

            if ($action === 'generate') {
                if (!empty($existingHolidays)) {
                    return redirect()->back()->with('error', 'Exceptional holidays for this year already exist.');
                }
                $employeeCursor = $employeesQuery->cursor();
            } elseif ($action === 'generate_for_new') {
                $employeeCursor = $employeesQuery->whereNotIn('employee_id', $existingHolidays)->cursor();
                if (!$employeeCursor->count()) {
                    return redirect()->back()->with('error', 'No new employees found for this year.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid action.');
            }

            $rows = [];
            $chunkSize = 500; 
            foreach ($employeeCursor as $employee) {
                if($action === 'generate'){
                    $empStartDate = Carbon::parse($employee->joining_date)->gt($start_date) ? Carbon::parse($employee->joining_date) : $start_date;
                }else{ 
                    $empStartDate = Carbon::parse($employee->joining_date);
                }

                if($employee->leaving_date){
                    $empEndDate = Carbon::parse($employee->leaving_date)->lt($end_date) ? Carbon::parse($employee->leaving_date) : $end_date;
                }else{
                    $empEndDate = $end_date;
                }

                $date = $empStartDate->copy();
                while ($date->lte($empEndDate)) {
                    if ($employee->refrerence_holiday == $date->format('l')) {
                        $rows[] = [
                            'year'         => (int) $year,
                            'org_id'       => $request->organization_id,
                            'employee_id'  => $employee->employee_id,
                            'holiday_date' => $date->format('Y-m-d'),
                            'created_by'   => Auth::id(),
                            'updated_by'   => Auth::id(),
                        ];
                    }
                    $date->addDay();
                }
                // Insert per chunk to reduce memory & DB overhead
                if (count($rows) >= $chunkSize) {
                    ExceptionalHoliday::insert($rows);
                    $rows = [];
                }
            }
            // Insert remaining rows
            if (!empty($rows)) {
                ExceptionalHoliday::insert($rows);
            }
            return redirect()->back()->with('success', 'Exceptional holidays generated successfully.');
        } catch (\Throwable $e) {
            Log::error('ExceptionalHoliday Generate Error: '.$e->getMessage(), [
                'user_id' => Auth::id(),
                'year' => $request->year,
                'organization_id' => $request->organization_id,
            ]);
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
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
    public function destroy(Request $request) {}
}
