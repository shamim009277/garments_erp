<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;
use Modules\HRIS\Http\Requests\Tools\ExceptionalHolidayRequest;

class ExceptionalHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hris::tools.exceptionalholiday.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExceptionalHolidayRequest $request) {
        date_default_timezone_set('Asia/Dhaka');
        $year = $request->year;
        $start_date = Carbon::createFromDate($year, 1, 1);
        $end_date   = Carbon::createFromDate($year, 12, 31);

        $employees = Employee::active()->shiftingDuty()->select('id','employee_id','refrerence_holiday','joining_date')->get();
        $exceptional_holidays = ExceptionalHoliday::where('year', $year)->get();

        if ($exceptional_holidays->isNotEmpty()) {
            return redirect()->back()->with('error', 'Exceptional holidays for this year already exists.');
        }else{
            $chunks = $employees->chunk(200);

            foreach($chunks as $datas){
                $rows = [];
                foreach($datas as $employee){
                    $employeeJoining = Carbon::parse($employee->joining_date);
                    $empStartDate = $employeeJoining->gt($start_date) ? $employeeJoining : $start_date;

                    $date = $empStartDate->copy();
                    while ($date->lte($end_date)) {
                        if($employee->refrerence_holiday == date('l', strtotime($date))){
                            $rows[] = [
                                'year'           => (int) $year,
                                'employee_id'    => $employee->employee_id,
                                'holiday_date'   => $date->format('Y-m-d'),
                                'created_by'     => Auth::id(),
                                'updated_by'     => Auth::id(),
                            ];
                        }
                        $date->addDay();
                    }
                }
                ExceptionalHoliday::insert($rows);
            }
            return redirect()->back()->with('success', 'Exceptional holidays generated successfully.');
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
