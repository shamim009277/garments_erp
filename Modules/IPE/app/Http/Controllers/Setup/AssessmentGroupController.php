<?php

namespace Modules\IPE\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Setup\Designation;
use Modules\IPE\Http\Requests\Setup\AssessmentGroupRequest;
use Modules\IPE\Models\Setup\AssessmentGroup;

class AssessmentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = DB::table('ipe_setup_assessment_groups as g')
            ->join('hris_setup_designations as d', 'd.id', '=', 'g.designation_id')
            ->selectRaw("
                MIN(g.id) as id,
                g.name,
                g.code,
                g.is_active,
                GROUP_CONCAT(DISTINCT d.designation ORDER BY d.designation SEPARATOR ' || ') as designations,
                GROUP_CONCAT(DISTINCT d.id ORDER BY d.id SEPARATOR ',') as designation_ids_raw
            ")
            ->groupBy('g.name', 'g.code', 'g.is_active')
            ->orderBy('g.name')
            ->get()
            ->map(function ($row) {
                $ids = $row->designation_ids_raw
                    ? explode(',', $row->designation_ids_raw)
                    : [];
                $row->designation_ids = json_encode(
                    array_map('strval', $ids)
                );
                unset($row->designation_ids_raw);
                return $row;
            });

        $exist = AssessmentGroup::pluck('designation_id')->toArray();
        $designations = Designation::active()->pluck('designation', 'id')->toArray();
        $designationswoexist = Designation::active()->whereNotIn('id', $exist)->pluck('designation', 'id')->toArray();

        return view('ipe::setup.assessmentgroup.index', compact('designations', 'groups', 'designationswoexist'));
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
    public function store(AssessmentGroupRequest $request) {
        try {
            foreach($request->designation_id as $designationId) {
                AssessmentGroup::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'designation_id' => $designationId,
                    'is_active' => $request->is_active,
                ]);

            }
            return redirect()->route('ipe.setup.assessment-groups.index')->with('success', 'Assessment group created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create assessment group. Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ipe::show');
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
    public function update(AssessmentGroupRequest $request, $id) {
        try {
            $code = AssessmentGroup::findOrFail($id)->code;
            AssessmentGroup::where('code', $code)->delete();

            $lastId = DB::table('ipe_setup_assessment_groups')->max('id') ?? 0;
            $newAutoIncrement = $lastId + 1;
            DB::statement("ALTER TABLE ipe_setup_assessment_groups AUTO_INCREMENT = {$newAutoIncrement}");

            foreach($request->designation_id as $designationId) {
                AssessmentGroup::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'designation_id' => $designationId,
                    'is_active' => $request->is_active,
                ]);

            }
            return redirect()->route('ipe.setup.assessment-groups.index')->with('success', 'Assessment group created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create assessment group. Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $code = AssessmentGroup::findOrFail($request->id)->code;
            AssessmentGroup::where('code', $code)->delete();

            $lastId = DB::table('ipe_setup_assessment_groups')->max('id') ?? 0;
            $newAutoIncrement = $lastId + 1;
            DB::statement("ALTER TABLE ipe_setup_assessment_groups AUTO_INCREMENT = {$newAutoIncrement}");

            return response()->json(['success' => true, 'message' => 'Assessment group deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete assessment group. Error: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        try {
            $group = AssessmentGroup::findOrFail($request->id);
            $code = $group->code;
            $newStatus = !$group->is_active;

            AssessmentGroup::where('code', $code)->update(['is_active' => $newStatus]);

            return response()->json(['success' => true, 'message' => 'Assessment group status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update assessment group status. Error: ' . $e->getMessage()]);
        }
    }
}
