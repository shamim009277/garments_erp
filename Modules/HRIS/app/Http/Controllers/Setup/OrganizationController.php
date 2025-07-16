<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Http\Requests\Setup\OrganizationRequest;
use App\Traits\ToggleStatus;

class OrganizationController extends Controller
{
    use ToggleStatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::all();
        return view('hris::setup.organizations.index', compact('organizations'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request) {
        try {
            Organization::create($request->validated());
            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create organization: ' . $th->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRequest $request, $id) {
        try {
            Organization::findOrFail($id)->update($request->validated());
            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update organization: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            Organization::findOrFail($id)->delete();
            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete organization: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Organization::class);
    }
}
