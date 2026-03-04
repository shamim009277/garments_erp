<?php

namespace Modules\SM\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SM\Models\Setup\Group;
use Modules\SM\Http\Requests\Setup\GroupRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class GroupController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $groups = Group::all();
        return view('sm::setup.groups.index', compact('groups'));
    }

    public function store(GroupRequest $request)
    {
        try {
            DB::beginTransaction();
            $prefix = 'G';
            $length = 2;
            $lastSerial = DB::table('sm_setup_groups')
                ->where('group_code', 'like', $prefix . '%')
                ->orderBy('group_code', 'desc')
                ->value('group_code');
            
            $lastNumber = $lastSerial ? (int) substr($lastSerial, strlen($prefix)) : 0;
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            
            Group::create([
                'group_code' => $prefix . $newNumber,
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('sms.setup.groups.index')->with('success', 'Group created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Group: ' . $e->getMessage());
        }
    }

    public function update(GroupRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            Group::findOrFail($id)->update($request->validated());
            DB::commit();
            return redirect()->route('sms.setup.groups.index')->with('success', 'Group updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Group: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Group::findOrFail($id)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Group deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Group: ' . $e->getMessage()]);
        }
    }
    
    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Group::class);
    }
}
