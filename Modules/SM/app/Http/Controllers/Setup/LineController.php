<?php

namespace Modules\SM\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SM\Models\Setup\Line;
use Modules\SM\Http\Requests\Setup\LineRequest;

use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;

class LineController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $lines = Line::all();
        return view('sm::setup.lines.index', compact('lines'));
    }

    public function store(LineRequest $request)
    {
        try {
            DB::beginTransaction();
            $prefix = 'L';
            $length = 2;
            $lastSerial = DB::table('sm_setup_lines')
                ->where('line_code', 'like', $prefix . '%')
                ->orderBy('line_code', 'desc')
                ->value('line_code');
            
            $lastNumber = $lastSerial ? (int) substr($lastSerial, strlen($prefix)) : 0;
            $newNumber = str_pad($lastNumber + 1, $length, '0', STR_PAD_LEFT);
            
            Line::create([
                'line_code' => $prefix . $newNumber,
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);
            
            DB::commit();
            return redirect()->route('sms.setup.lines.index')->with('success', 'Line created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Line: ' . $e->getMessage());
        }
    }

    public function update(LineRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            Line::findOrFail($id)->update($request->validated());
            DB::commit();
            return redirect()->route('sms.setup.lines.index')->with('success', 'Line updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Line: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Line::findOrFail($id)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Line deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete Line: ' . $e->getMessage()]);
        }
    }
    
    public function toggleStatus(Request $request)
    {
        return $this->toggleStatusTrait($request, Line::class);
    }
}
