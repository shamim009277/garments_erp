<?php

namespace Modules\IPE\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\Organization;
use Modules\IPE\Http\Requests\Setting\AssessmentRequest;
use Modules\IPE\Models\Setting\AssessmentAccess;

class AssessmentAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::active()->pluck('department', 'id');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $users = User::active()->get();
        $activeUsers = $users->pluck('active_user', 'id');
        $datas = AssessmentAccess::with(['user:id,name,employee_id', 'department:id,department', 'organization:id,short_name'])->orderBy('user_id', 'desc')->orderBy('id', 'desc')->get();

        return view('ipe::settings.assessment-access.index', compact('departments', 'organizations', 'activeUsers', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ipe::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssessmentRequest $request)
    {
        $request->validated();
        try {
            $request->validated();
            AssessmentAccess::create($request->validated());
            return redirect()->route('ipe.settings.assessment-access.index')->with('success', 'Assessment access created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create assessment access: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function replace(Request $request)
    {
        if ($request->existing_user == $request->replace_user) {
            return redirect()->back()->with('error', 'Existing user and replace user cannot be the same');
        }

        $exists = AssessmentAccess::where('user_id', $request->existing_user)->where('org_id', $request->org_id2)->first();
        if (!$exists) {
            return redirect()->back()->with('error', 'Existing user does not have assessment access');
        }

        try {
            $exisdata = AssessmentAccess::where('user_id', $request->existing_user)
                ->where('org_id', $request->org_id2)
                ->get();

            $repdata = AssessmentAccess::where('user_id', $request->replace_user)
                ->where('org_id', $request->org_id2)
                ->pluck('department_id')
                ->toArray();

            foreach ($exisdata as $data) {

                if (in_array($data->department_id, $repdata)) {
                    continue;
                }

                AssessmentAccess::create([
                    'user_id'       => $request->replace_user,
                    'org_id'        => $data->org_id,
                    'department_id' => $data->department_id,
                    'type'          => $data->type,
                    'created_by'    => auth()->id(),
                    'updated_by'    => auth()->id(),
                ]);
            }

            /* old user data delete */
            AssessmentAccess::where('user_id', $request->existing_user)
                ->where('org_id', $request->org_id2)
                ->delete();

            return redirect()->route('ipe.settings.assessment-access.index')->with('success', 'Assessment access replaced successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to replace assessment access: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ipe::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $data = AssessmentAccess::find($request->id);
            $data->delete();
            return redirect()->route('ipe.settings.assessment-access.index')->with('success', 'Assessment access deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete shift: ' . $e->getMessage());
        }
    }
}
