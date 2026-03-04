<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\TeamMember;
use Modules\OrderManagement\Models\Setup\Team;
use Modules\HRIS\Models\Database\Employee;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class TeamMemberController extends Controller
{
    use ToggleStatus;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch teams with their members
        $teams = Team::with(['members.merchant', 'organization'])->latest()->get();
        
        // Fetch active employees for selection
        $merchants = Employee::where('is_active', true)
            ->select('id', 'employee_id', 'name')
            ->orderBy('name')
            ->get();
            
        return view('ordermanagement::setup.teammembers.index', compact('teams', 'merchants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used in new UI structure
        return redirect()->route('ordermanagement.setup.teammembers.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:om_setup_team,id',
            'leader_id' => 'nullable|exists:hris_database_employee_basic,id',
            'assistant_id' => 'nullable|exists:hris_database_employee_basic,id',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:hris_database_employee_basic,id',
        ]);

        DB::beginTransaction();
        try {
            $this->saveTeamMembers($request->team_id, $request);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.teammembers.index')->with('success', 'Team members assigned successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to assign team members: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // Not used
        return redirect()->route('ordermanagement.setup.teammembers.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Not used
        return redirect()->route('ordermanagement.setup.teammembers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $id is Team ID
        $request->validate([
            'leader_id' => 'nullable|exists:hris_database_employee_basic,id',
            'assistant_id' => 'nullable|exists:hris_database_employee_basic,id',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:hris_database_employee_basic,id',
        ]);

        DB::beginTransaction();
        try {
            $this->saveTeamMembers($id, $request);
            
            DB::commit();
            return redirect()->route('ordermanagement.setup.teammembers.index')->with('success', 'Team members updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update team members: ' . $e->getMessage());
        }
    }

    /**
     * Common logic to save team members
     */
    private function saveTeamMembers($teamId, Request $request)
    {
        $team = Team::findOrFail($teamId);
        
        // Clear existing members
        TeamMember::where('team_id', $team->id)->delete();

        // Collect all unique merchant IDs to process
        $allMerchantIds = [];
        
        if ($request->leader_id) {
            $allMerchantIds[] = $request->leader_id;
        }
        
        if ($request->assistant_id) {
            $allMerchantIds[] = $request->assistant_id;
        }
        
        if ($request->has('member_ids') && is_array($request->member_ids)) {
            $allMerchantIds = array_merge($allMerchantIds, $request->member_ids);
        }
        
        // Remove duplicates
        $uniqueMerchantIds = array_unique($allMerchantIds);
        
        foreach ($uniqueMerchantIds as $merchantId) {
            TeamMember::create([
                'team_id' => $team->id,
                'merchant_id' => $merchantId,
                'is_leader' => ($merchantId == $request->leader_id) ? 1 : 0,
                'is_assistant' => ($merchantId == $request->assistant_id) ? 1 : 0,
                'is_active' => 1
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            // Clear assignments for the team
            TeamMember::where('team_id', $id)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Team members cleared successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear team members: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Team::class);
    }
}
