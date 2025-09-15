<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Http\Requests\Setup\EmployeeCategoryRequest;
use App\Traits\ToggleStatus;

class EmployeeCategoryController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.employee-category.view')->only('index');
        $this->middleware('permission:hris.employee-category.add')->only('store');
        $this->middleware('permission:hris.employee-category.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.employee-category.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeCategories = EmployeeCategory::all();
        return view('hris::setup.employeecategories.index', compact('employeeCategories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeCategoryRequest $request) {
        try {
            EmployeeCategory::create($request->validated());
            return redirect()->route('hris.setup.employeecategories.index')->with('success', 'Employee Category created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create employee category: ' . $th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeCategoryRequest $request, $id) {
        try {
            $employeeCategory = EmployeeCategory::findOrFail($id);
            $employeeCategory->update($request->validated());
            return redirect()->route('hris.setup.employeecategories.index')->with('success', 'Employee Category updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update employee category: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            EmployeeCategory::findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'Employee Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Employee Category deletion failed: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, EmployeeCategory::class);
    }
}
