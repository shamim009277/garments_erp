<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\Team;
use Modules\OrderManagement\Http\Requests\Setup\TeamRequest;
use Modules\HRIS\Models\Setup\Organization;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:inventory.teams.view')->only('index','show');
    //     $this->middleware('permission:inventory.teams.add')->only('store');
    //     $this->middleware('permission:inventory.teams.edit')->only(['edit', 'update','toggleStatus']);
    //     $this->middleware('permission:inventory.teams.delete')->only('destroy');
    // }
   
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('organization')->get();
        $organizations = Organization::all();
        return view('ordermanagement::setup.teams.index', compact('teams','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::all();
        return view('ordermanagement::setup.teams.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $team = Team::create([
                'team_name' => $request->team_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
                
            ]);
            // return $team;
            DB::commit();
            return redirect()->route('ordermanagement.setup.teams.index')->with('success', 'Team created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create team: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $team = Team::findOrFail($id);
        return view('ordermanagement::setup.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $organizations = Organization::all();
        return view('ordermanagement::setup.teams.edit', compact('team', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $team = Team::findOrFail($id);
            $team->update([
                'team_name' => $request->team_name,
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
                
            ]);
            DB::commit();
            return redirect()->route('ordermanagement.setup.teams.index')->with('success', 'Team updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update team: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $team = Team::findOrFail($id);
            $team->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Team deleted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete team: ' . $e->getMessage(),
            ]);
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Team::class);
    }
}
