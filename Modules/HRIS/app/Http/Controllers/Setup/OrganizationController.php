<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Http\Requests\Setup\OrganizationRequest;

class OrganizationController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.organizations.view')->only('index');
        $this->middleware('permission:hris.organizations.add')->only('store');
        $this->middleware('permission:hris.organizations.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.organizations.delete')->only('destroy');
    }
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
            $data = $request->validated();
            $fileUploadService = new FileUploadService();

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $fileUploadService->upload($logo, 'logo', []);
                $data['icon_name'] = $logoPath['name'];
                $data['path'] = $logoPath['path'];
            }

            Organization::create($data);
            cache()->forget('ornizations_data');
            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create organization: ' . $th->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRequest $request, $id)
    {
        try {
            $organization = Organization::findOrFail($id);
            $data = $request->validated();
            $fileUploadService = new FileUploadService();

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $fileUploadService->upload($logo, 'logo', []);
                $data['icon_name'] = $logoPath['name'];
                $data['path'] = $logoPath['path'];
            }

            $organization->update($data);
            cache()->forget('ornizations_data');

            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update organization: ' . $th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $organization = Organization::findOrFail($id);
            $fileUploadService = new FileUploadService();
            if ($organization->path) {
                $fileUploadService->delete($organization->path);
            }
            $organization->delete();
            cache()->forget('ornizations_data');
            return redirect()->route('hris.setup.organizations.index')->with('success', 'Organization deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete organization: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, Organization::class);
    }
}
