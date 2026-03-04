<?php

namespace Modules\OrderManagement\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Setup\WashType;
use Modules\OrderManagement\Http\Requests\Setup\WashTypeRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;

class WashTypeController extends Controller
{
    use ToggleStatus;

    public function index()
    {
        $washtypes = WashType::orderBy('id', 'desc')->get();
        return view('ordermanagement::setup.washtypes.index', compact('washtypes'));
    }

    public function store(WashTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            
            // Generate code (e.g., WT001)
            $lastWashType = WashType::orderBy('id', 'desc')->first();
            $newId = $lastWashType ? $lastWashType->id + 1 : 1;
            $data['wash_type_code'] = 'WT' . str_pad($newId, 3, '0', STR_PAD_LEFT);
            
            WashType::create($data);
            
            DB::commit();
            return redirect()->back()->with('success', 'Wash Type created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $washType = WashType::findOrFail($id);
        return response()->json($washType);
    }

    public function update(WashTypeRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $washType = WashType::findOrFail($id);
            $washType->update($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Wash Type updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $washType = WashType::findOrFail($request->id);
            $washType->delete();
            return redirect()->back()->with('success', 'Wash Type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
