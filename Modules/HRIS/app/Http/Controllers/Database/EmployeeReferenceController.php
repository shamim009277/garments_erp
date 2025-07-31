<?php

namespace Modules\HRIS\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Http\Requests\Database\EmployeeReferenceRequest;
use Modules\HRIS\Models\Database\EmployeeReference;

class EmployeeReferenceController extends Controller
{

    public function store(EmployeeReferenceRequest $request) {
        try {
            $employeeReference = EmployeeReference::create($request->validated());
            return redirect()->back()->with('success', 'Employee Reference created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create employee reference: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeReferenceRequest $request, $id) {
        try {
            $employeeReference = EmployeeReference::findOrFail($id);
            $employeeReference->update($request->validated());
            return redirect()->back()->with('success', 'Employee Reference updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update employee reference: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            EmployeeReference::findOrFail($request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Employee Reference deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Employee Reference deletion failed: ' . $e->getMessage()]);
        }
    }
}
