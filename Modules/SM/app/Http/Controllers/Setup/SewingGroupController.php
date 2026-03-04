<?php

namespace Modules\SM\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SM\Models\Setup\Group;
use Modules\SM\Models\Setup\SewingGroupEmployee;
use Modules\SM\Http\Requests\Setup\SewingGroupRequest;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class SewingGroupController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        // Fetch all groups with their assigned employees
        $sewingGroups = Group::with('sewingGroupEmployees.employee')->latest()->get();
        
        // Fetch active employees for selection
        $employees = Employee::where('is_active', true)
            ->select('id', 'employee_id', 'name')
            ->orderBy('name')
            ->get();
            
        // Fetch all active groups for the selection dropdown (if creating new assignment)
        $groups = Group::where('is_active', true)->get();

        return view('sm::setup.sewing_groups.index', compact('sewingGroups', 'employees', 'groups'));
    }

    public function store(SewingGroupRequest $request)
    {
        DB::beginTransaction();
        try {
            $group = Group::findOrFail($request->group_id);
            
            // Update group active status
            $group->update(['is_active' => $request->is_active]);

            // Sync employees: delete old, add new
            SewingGroupEmployee::where('group_id', $group->id)->delete();

            if ($request->has('employee_ids') && is_array($request->employee_ids)) {
                foreach ($request->employee_ids as $employeeId) {
                    SewingGroupEmployee::create([
                        'group_id' => $group->id,
                        'employee_id' => $employeeId
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->route('sms.setup.sewing_groups.index')->with('success', 'Employees assigned to group successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to assign employees: ' . $e->getMessage());
        }
    }

    public function update(SewingGroupRequest $request, $id)
    {
        // In this context, $id is the group_id since we are listing Groups
        DB::beginTransaction();
        try {
            $group = Group::findOrFail($id);
            
            // Update group active status
            $group->update(['is_active' => $request->is_active]);

            // Sync employees: delete old, add new
            SewingGroupEmployee::where('group_id', $group->id)->delete();

            if ($request->has('employee_ids') && is_array($request->employee_ids)) {
                foreach ($request->employee_ids as $employeeId) {
                    SewingGroupEmployee::create([
                        'group_id' => $group->id,
                        'employee_id' => $employeeId
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('sms.setup.sewing_groups.index')->with('success', 'Group assignment updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update assignment: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Remove all employee assignments for this group
            // We do NOT delete the Group itself, just the assignments
            SewingGroupEmployee::where('group_id', $id)->delete();
            return response()->json(['success' => true, 'message' => 'Assignments cleared successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to clear assignments']);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Group::class);
    }
}
