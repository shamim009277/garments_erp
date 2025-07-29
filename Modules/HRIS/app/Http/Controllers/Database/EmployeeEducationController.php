<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\EmployeeEducation;
use Modules\HRIS\Http\Requests\Database\EmployeeEducationRequest;

class EmployeeEducationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeEducationRequest $request)
    {
        DB::beginTransaction();
        try {
            $education = new EmployeeEducation();
            $education->employee_id = $request->employee_id;
            $education->degree_id = $request->degree_id;
            $education->passing_year = $request->passing_year;
            $education->institute = $request->institute;
            $education->institute_bangla = $request->institute_bangla;
            $education->board = $request->board;
            $education->result_type = $request->result_type;
            if($education->result_type == 'D') {
                $education->result = $request->obtain_degree;
            } elseif($education->result_type == 'C') {
                $education->result = $request->obtain_cgpa;
            } elseif($education->result_type == 'G') {
                $education->result = $request->obtain_grade;
            }
            $education->is_active = true;
            $education->save();

            DB::commit();
            return redirect()->back()->with('success', 'Employee Education created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Employee Education: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeEducationRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $employeeEducation = EmployeeEducation::findOrFail($id);
            $employeeEducation->update($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Employee Education updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update Employee Education: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        DB::beginTransaction();
        try {
            $employeeEducation = EmployeeEducation::findOrFail($request->id);
            $employeeEducation->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Employee Education deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete Employee Education: ' . $e->getMessage());
        }
    }
}
