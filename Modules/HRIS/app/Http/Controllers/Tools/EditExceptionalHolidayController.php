<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Tools\ExceptionalHoliday;

class EditExceptionalHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hris::tools.editexceptionalholiday.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if($request->form == 1){
            $holidays = ExceptionalHoliday::with('employeeBasic')->active()->where('holiday_date', $request->date)->get();
            return response()->json([
                'success' => true,
                'data' => $holidays
            ]);
        }else if($request->form == 2){
            $holidays = ExceptionalHoliday::with('employeeBasic')->active()->where('employee_id', $request->emp_id)->whereBetween('holiday_date', [$request->start_date, $request->end_date])->get();
            return response()->json([
                'success' => true,
                'data' => $holidays
            ]);
        }else if($request->form == 3){
            $exists = ExceptionalHoliday::where('employee_id', $request->emp_id)
                ->whereBetween('holiday_date', [$request->start_date, $request->end_date])
                ->exists();

            if ($exists) {
                ExceptionalHoliday::where('employee_id', $request->emp_id)
                    ->whereBetween('holiday_date', [$request->start_date, $request->end_date])
                    ->delete();
            }

            $date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            $year = Carbon::parse($request->start_date)->year;

            $rows = [];
            while ($date->lte($end_date)) {
                if($request->holiday == date('l', strtotime($date))){
                    $rows[] = [
                        'year'           => (int) $year,
                        'employee_id'    => $request->emp_id,
                        'holiday_date'   => $date->format('Y-m-d'),
                        'created_by'     => Auth::id(),
                        'updated_by'     => Auth::id(),
                    ];
                }
                $date->addDay();
            }
            ExceptionalHoliday::insert($rows);

            $holidays = ExceptionalHoliday::with('employeeBasic')->active()->where('employee_id', $request->emp_id)->whereBetween('holiday_date', [$request->start_date, $request->end_date])->get();
            return response()->json([
                'success' => true,
                'data' => $holidays
            ]);
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
    public function destroy(Request $request) {
        $id = $request->id;
        ExceptionalHoliday::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Exceptional holiday deleted successfully.'
        ]);
    }
}
