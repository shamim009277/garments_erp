<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\EmployeeService;
use Modules\HRIS\Http\Requests\Database\EmployeeServiceRequest;

class EmployeeServiceController extends Controller
{
    public function store(EmployeeServiceRequest $request)
    {
        try {
            $employeeService = EmployeeService::create($request->validated());
            return redirect()->back()->with('success', 'Employee Service created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Employee Service: ' . $e->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeServiceRequest $request, $id)
    {
        try {
            $employeeService = EmployeeService::findOrFail($id);
            $validatedData = $request->validated();

            $employeeService->fill($validatedData);

            if ($employeeService->isDirty()) {
                $employeeService->updated_by = Auth::id();
                $employeeService->save();
                return redirect()->back()->with('success', 'Employee Service updated successfully');
            } else {
                return redirect()->back()->with('info', 'No changes detected to update.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update Employee Service: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $employeeService = EmployeeService::findOrFail($request->id);
            $employeeService->delete();
            return redirect()->back()->with('success', 'Employee Service deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete Employee Service: ' . $th->getMessage());
        }
    }
}
