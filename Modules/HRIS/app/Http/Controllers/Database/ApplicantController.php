<?php

namespace Modules\HRIS\Http\Controllers\Database;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Line;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Http\Requests\Database\ApplicantRequest;

class ApplicantController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.new-applicants.view')->only('index','show','getSearch');
        $this->middleware('permission:hris.new-applicants.add')->only('store');
        $this->middleware('permission:hris.new-applicants.edit')->only(['edit', 'update']);
        $this->middleware('permission:hris.new-applicants.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(18)->addDays(1)->format('d-m-Y');
        $departments = Department::active()->pluck('department', 'id');
        $designations = Designation::active()->pluck('designation', 'id');
        $districts = District::active()->pluck('name', 'id');
        $lines = Line::active()->pluck('line', 'code');
        $organizations = Organization::active()->pluck('short_name', 'id');

        //\DB::enableQueryLog();
        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation','organization:id,short_name'])
            ->active()
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->get();

        $unique_applicant = [];
        //dd(\DB::getQueryLog());
        $unique_department = $pending_applicants->unique('department_id');
        return view('hris::database.newapplicant.index', compact('departments', 'designations', 'districts', 'pending_applicants','unique_applicant','unique_department','today','organizations','maxDate','lines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hris::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicantRequest $request)
    {
        $mobile_exist = Applicant::where('mobile', $request->mobile)->exists();
        if ($mobile_exist) {
            return redirect()->back()->with('error', 'Mobile number already exists');
        }
        $national_id_exist = Applicant::where('national_id', $request->national_id)->whereNotNull('national_id')->exists();
        if ($national_id_exist) {
            return redirect()->back()->with('error', 'National ID already exists');
        }
        $birth_certificate_no_exist = Applicant::where('birth_certificate_no', $request->birth_certificate_no)->whereNotNull('birth_certificate_no')->exists();
        if ($birth_certificate_no_exist) {
            return redirect()->back()->with('error', 'Birth Certificate No already exists');
        }
        try {
            $data = $request->validated();
            $data['entry_date'] = date('Y-m-d');
            $data['birth_date'] = Carbon::parse($request->birth_date)->format('Y-m-d');
            $data['interview_status'] = 'Pending';
            $applicant = Applicant::create($data);
            return redirect()->route('hris.database.new-applicants.show', $applicant->id)->with('success', 'Applicant created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create applicant: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);
        $departments = Department::active()->pluck('department', 'id');
        $designations = Designation::active()->pluck('designation', 'id');
        $districts = District::active()->pluck('name', 'id');
        $organizations = Organization::active()->pluck('short_name', 'id');

        $today = Carbon::now()->format('d-m-Y');
        $maxDate = Carbon::now()->subYears(18)->addDays(1)->format('d-m-Y');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $lines = Line::active()->pluck('line', 'code');

        $pending_applicants = Applicant::with(['department:id,department', 'designation:id,designation'])
            ->active()
            ->noFileEntry()
            ->where('entry_date', '>=', $lst_30_days)
            ->where('final_status', 0)
            ->get();

        $unique_applicant = Applicant::with(['department:id,department', 'designation:id,designation'])->where('id', $id)->first();
        $unique_department = $pending_applicants->unique('department_id');

        return view('hris::database.newapplicant.index', compact('applicant', 'departments', 'designations', 'districts', 'pending_applicants', 'unique_applicant', 'unique_department','today','organizations','maxDate','lines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplicantRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $applicant = Applicant::findOrFail($id);
            if($data['interview_status'] == 'Selected'){
                $data['final_status'] = 1;
            }else if($data['interview_status'] == 'Disqualify'){
                $data['final_status'] = 2;
            }else if($data['interview_status'] == 'Not Recruit'){
                $data['final_status'] = 3;
            }else if($data['interview_status'] == 'Pending'){
                $data['final_status'] = 0;
            }

            if(!isset($data['final_designation_id']) || $data['final_designation_id'] == null){
                $data['final_designation_id'] = $applicant->designation_id;
            }
            $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
            $data['joining_date'] = Carbon::parse($data['joining_date'])->format('Y-m-d');
            $applicant->update($data);
            return redirect()->back()->with('success', 'Applicant updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update applicant: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        try {
            $applicant = Applicant::findOrFail($request->id);
            if($applicant->file_entry != 'N'){
                return response()->json(['success' => false, 'message' => 'Applicant deletion failed: Applicant has file entry']);
            }
            if($applicant->interview_status == 'Selected' || $applicant->interview_status == 'Disqualify' || $applicant->interview_status == 'Not Recruit'){
                return response()->json(['success' => false, 'message' => 'Applicant deletion failed: Applicant is selected, disqualified or not recruit']);
            }
            if($applicant->file_entry == 'N'){
                $applicant->delete();
                return response()->json(['success' => true, 'message' => 'Applicant deleted successfully']);
            }
            return response()->json(['success' => false, 'message' => 'Applicant deletion failed: Applicant has file entry']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Applicant deletion failed: ' . $e->getMessage()]);
        }
    }

    public function getSearch(Request $request){
        $search = trim($request->search);
        try {
            $applicant = Applicant::findOrFail($search);
            if($applicant){
                return redirect()->route('hris.database.new-applicants.show', $applicant->id)->with('success', 'Applicant found successfully');
            }else{
                return redirect()->back()->with('error', 'Applicant not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to search applicant: Applicant not found');
        }
    }
}
