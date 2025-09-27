<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\Setup\ParentDepartment;
use App\Jobs\Modules\HRIS\GenerateShiftingListJob;
use Modules\HRIS\Http\Requests\Tools\ShiftingListRequest;

class ShiftingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        return view('hris::tools.shiftinglist.index', compact('parentDepartments'));
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
    public function store(ShiftingListRequest $request)
    {
        try {
            $year = $request->year;
            $userId = Auth::id();

            foreach ($request->parent_department_id as $parentId) {
                $departmentIds = Department::where('parent_department_id', $parentId)
                                    ->pluck('id')
                                    ->toArray();

                if(!empty($departmentIds)){
                    GenerateShiftingListJob::dispatch($year, $departmentIds, $userId);
                }
            }

            return redirect()->back()->with('success', 'Shifting list jobs have been queued. You will be notified when it is done.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
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
