<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\HRIS\Http\Requests\Tools\ShiftingListRequest;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Tools\ShiftingList;
use Modules\HRIS\Models\JobStatus;
use Modules\HRIS\Jobs\GenerateShiftingListJob;

use Illuminate\Support\Facades\Bus;

class ShiftingListController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.shifting-list.view')->only('index');
        $this->middleware('permission:hris.shifting-list.add')->only('store');
        $this->middleware('permission:hris.shifting-list.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.shifting-list.delete')->only('destroy');
    }
    
    public function index()
    {
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $organizations = Organization::active()->pluck('short_name', 'id');
        return view('hris::tools.shiftinglist.index', compact('parentDepartments', 'organizations'));
    }

    public function create()
    {
        return view('hris::create');
    }

    public function store(ShiftingListRequest $request)
    {
        try {
            $year = (int) $request->year;
            $organizationId = $request->organization_id;
            $departmentIds = $request->department_id;
            $userId = Auth::id();

            // Quick check if already exists to return early
            $exists = ShiftingList::where('year', $year)
                ->when($organizationId, fn($q) => $q->where('org_id', $organizationId))
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shifting list for this year already exists.'
                ]);
            }

            // Create Job Status Record
            $jobStatus = JobStatus::create([
                'job_id' => (string) Str::uuid(),
                'user_id' => $userId,
                'status' => 'pending',
                'progress' => 0,
                'message' => 'Job queued...'
            ]);

            // Dispatch Job with Job Status ID
            GenerateShiftingListJob::dispatch($year, $departmentIds, $organizationId, $userId, $jobStatus->id);

            return response()->json([
                'success' => true,
                'message' => 'Shifting list generation started.',
                'job_status_id' => $jobStatus->id
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function checkStatus($id)
    {
        $jobStatus = JobStatus::find($id);

        if (!$jobStatus) {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $jobStatus->status,
            'progress' => $jobStatus->progress,
            'message' => $jobStatus->message
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

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
