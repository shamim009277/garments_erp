<?php

namespace Modules\SM\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\SM\Models\Setup\SewingLine;
use Modules\SM\Models\Setup\Line;
use Modules\SM\Models\Setup\Group;
use Modules\HRIS\Models\Database\Employee;
use Modules\SM\Http\Requests\Setup\SewingLineRequest;
use App\Traits\ToggleStatus;

class SewingLineController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $sewingLines = SewingLine::with(['line', 'incharge', 'groups'])->latest()->get();
        
        // Fetch data for dropdowns
        $lines = Line::whereDoesntHave('sewingLine')->get(); // Only show lines not yet configured? Or all? 
        // If I show all, and user selects one already configured, validation fails. 
        // Better to show all but mark used? Or filter?
        // Let's show all for now, as validation handles unique.
        // Actually, if I filter out used ones, user can't select them to create duplicates, which is good UX.
        // But for Edit, we need the current one.
        // Let's just fetch all Lines for now to be safe.
        $lines = Line::all();

        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $groups = Group::active()->get();

        return view('sm::setup.sewing_lines.index', compact('sewingLines', 'lines', 'employees', 'groups'));
    }

    public function store(SewingLineRequest $request)
    {
        DB::beginTransaction();
        try {
            $sewingLine = SewingLine::create([
                'line_id' => $request->line_id,
                'line_incharge_id' => $request->line_incharge_id,
                'total_machine' => $request->total_machine,
                'is_active' => $request->is_active,
            ]);

            if ($request->has('group_ids')) {
                $sewingLine->groups()->attach($request->group_ids);
            }

            DB::commit();
            return redirect()->route('sms.setup.sewing_lines.index')->with('success', 'Sewing Line configured successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to configure Sewing Line: ' . $e->getMessage())->withInput();
        }
    }

    public function update(SewingLineRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $sewingLine = SewingLine::findOrFail($id);
            
            $sewingLine->update([
                'line_id' => $request->line_id,
                'line_incharge_id' => $request->line_incharge_id,
                'total_machine' => $request->total_machine,
                'is_active' => $request->is_active,
            ]);

            if ($request->has('group_ids')) {
                $sewingLine->groups()->sync($request->group_ids);
            } else {
                $sewingLine->groups()->detach();
            }

            DB::commit();
            return redirect()->route('sms.setup.sewing_lines.index')->with('success', 'Sewing Line updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Sewing Line: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sewingLine = SewingLine::findOrFail($id);
            $sewingLine->delete();
            return redirect()->route('sms.setup.sewing_lines.index')->with('success', 'Sewing Line deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Sewing Line: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, SewingLine::class);
    }
}
