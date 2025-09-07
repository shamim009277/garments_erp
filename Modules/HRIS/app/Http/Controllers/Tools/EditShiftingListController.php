<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('hris::tools.editshiftinglist.index', compact('startDate', 'endDate'));
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
    public function store(Request $request) {
        if($request->form == 1){
            $shiftingLists = ShiftingList::with('employeeBasic')->where('date', $request->date)->get();
            return response()->json([
                'success' => true,
                'data' => $shiftingLists
            ]);
        }else if($request->form == 2){
            $shiftingLists = ShiftingList::with('employeeBasic')->where('employee_id', (int)$request->emp_id)->whereBetween('date', [$request->start_date, $request->end_date])->get();
            return response()->json([
                'success' => true,
                'data' => $shiftingLists
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
    public function update(Request $request, $id) {
        $request->validate([
            'form' => 'required',
            'shift' => 'required|exists:hris_setup_shifts,shift',
        ]);

        try {
            if($request->form == 1){
                $shiftingList = ShiftingList::find($id);

                $shiftingList->shift = $request->shift;
                $shiftingList->save();
            }
            return response()->json([
                'success' => true,
                'message' => 'Shift updated successfully'
            ]);
        } catch (\Throwable $th) {
           return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
