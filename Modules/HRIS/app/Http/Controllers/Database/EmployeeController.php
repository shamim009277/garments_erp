<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Setup\Sex;
use Illuminate\Support\Facades\Log;
use Modules\HRIS\Models\Setup\Line;
use Modules\HRIS\Models\Setup\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Shift;
use Modules\HRIS\Models\Setup\Thana;
use Modules\HRIS\Models\Setup\Degree;
use App\Services\TextTranslateService;
use Modules\HRIS\Models\Setup\District;
use Modules\HRIS\Models\Setup\Document;
use Modules\HRIS\Models\Setup\Religion;
use Modules\HRIS\Models\Setup\Department;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Database\Applicant;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\MaritalStatus;
use Modules\HRIS\Models\Setup\Nationalities;
use Modules\HRIS\Models\Setup\EducationBoard;
use Modules\HRIS\Models\Database\EmployeeBangla;
use Modules\HRIS\Models\Database\EmployeeSalary;
use Modules\HRIS\Models\Database\EmployeeService;
use Modules\HRIS\Models\Database\EmployeeDocument;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Models\Database\EmployeeTraining;
use Modules\HRIS\Models\Database\EmployeeEducation;
use Modules\HRIS\Models\Database\EmployeeReference;
use Modules\HRIS\Models\Database\EmployeeExperience;
use Modules\HRIS\Http\Requests\Database\EmployeeRequest;
use Modules\HRIS\Http\Requests\Database\EmployeeBanglaRequest;
use Modules\HRIS\Http\Requests\Database\EmployeeSalaryRequest;
use Modules\HRIS\Http\Requests\Database\EmployeeDocumentRequest;
use Modules\HRIS\Http\Requests\Database\EmployeePersonalRequest;

class EmployeeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:hris.employee.view')->only('index','show','getEmployeeInfo','getSearch');
        $this->middleware('permission:hris.employee.add')->only('store');
        $this->middleware('permission:hris.employee.edit')->only(['edit', 'update','storeEmployeeSalary','storeEmployeeDocument','storeEmployeePersonal','storeEmployeeBangla','storeEmployeeExperience']);
        $this->middleware('permission:hris.employee.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $lst_30_days = Carbon::now()->subDays(30)->format('Y-m-d');
        $designations = Designation::active()->pluck('designation', 'id');
        $departments = Department::active()->pluck('department', 'id');

        $districts = District::active()->pluck('name', 'id');
        $shifts = Shift::active()->pluck('shift', 'shift');
        $units = Unit::active()->pluck('unit', 'code');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $applicants = Applicant::with(['department:id,department', 'designation:id,designation'])->active()->fileEntry()->where('entry_date', '>=', $lst_30_days)->where('file_entry','!=', 'C')->where('final_status', 1)->get();
        $unique_department = $applicants->unique('department_id');
        return view('hris::database.employee.index', compact('designations', 'departments', 'districts', 'applicants', 'unique_department', 'shifts', 'organizations', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            // 1. Create employee
            $employeeData = $request->validated();
            $employee = Employee::create($employeeData);

            // 2. Fetch dependent data first
            $empEntryCheck = Applicant::select('determined_salary','id','employee_id','file_entry')->where('employee_id', $employee->employee_id)->first();
            if($empEntryCheck){
                $empEntryCheck->update([
                    'file_entry' => 'C',
                ]);
            }

            $initial_salary = $empEntryCheck->determined_salary ?? 0;
            $hr_setting = Setting::active()->select('medical_allowance', 'food_allowance', 'conveyance', 'house_rant_percent_basic')->first();

            $medical = $hr_setting->medical_allowance ?? 0;
            $food = $hr_setting->food_allowance ?? 0;
            $convey = $hr_setting->conveyance ?? 0;
            $house_percent = $hr_setting->house_rant_percent_basic ?? 0;
            $total_allowance = $medical + $food + $convey;

            // 3. Salary calculations
            $basic = 0;
            if (($initial_salary - $total_allowance) > 0 && ($house_percent + 100) > 0) {
                $basic = round(($initial_salary - $total_allowance) / (($house_percent + 100) / 100));
            }

            // 4. Insert salary
            EmployeeSalary::insert([
                'employee_id'       => $employee->employee_id,
                'org_id'            => $employee->org_id,
                'gross_salary'      => $initial_salary,
                'medical_allowance' => $medical,
                'food_allowance'    => $food,
                'conveyance'        => $convey,
                'other_allowance'   => 0,
                'basic'             => $basic,
                'home_allowance'    => round(($basic / 100) * $house_percent),
                'ot_rate'           => round(($basic / 240) * 2),
                'created_by'        => Auth::id(),
                'updated_by'        => Auth::id(),
            ]);

            $employee_bangla_data = [
                'employee_id'           => $employee->employee_id,
                'org_id'                => $employee->org_id,
                'name_bangla'           => $employee->name,
                'fname_bangla'          => $employee->father_name,
                'mname_bangla'          => $employee->mother_name,
                'pdistrict_id_bangla'   => $employee->pdistrict_id,
                'pthana_id_bangla'      => $employee->pthana_id,
                'ppost_office_bangla'   => $employee->ppost_office,
                'pvillage_bangla'       => $employee->pvillage,
                'mdistrict_id_bangla'   => $employee->mdistrict_id,
                'mthana_id_bangla'      => $employee->mthana_id,
                'mpost_office_bangla'   => $employee->mpost_office,
                'mvillage_bangla'       => $employee->mvillage,
                'created_by'        => Auth::id(),
                'updated_by'        => Auth::id(),
            ];
            EmployeeBangla::insert($employee_bangla_data);
            DB::commit();
            return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 1])->with('success', 'Employee created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Employee Store Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return redirect()->back()->with('error', 'Failed to create employee: ' . $th->getMessage());
        }
    }


    /**
     * Show the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tab = $request->get('tab', 1);
        
        if($tab == 1){
            $employee = Employee::find($id);
            $designations = Designation::active()->pluck('designation', 'id');
            $departments = Department::active()->pluck('department', 'id');

            $districts = District::active()->pluck('name', 'id');
            $thanas = Thana::active()->pluck('name', 'id');
            $units = Unit::active()->pluck('unit', 'code');
            $lines = Line::active()->pluck('line', 'code');
            $shifts = Shift::active()->pluck('shift', 'shift');
            $organizations = Organization::active()->pluck('short_name', 'id');
            if ($request->ajax()) {
                return view('hris::database.employee.tab1', ['employee' => $employee, 'tab' => $tab, 'designations' => $designations, 'departments' => $departments, 'districts' => $districts, 'thanas' => $thanas, 'shifts' => $shifts, 'organizations' => $organizations, 'units' => $units, 'lines' => $lines]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'designations' => $designations, 'departments' => $departments, 'districts' => $districts, 'thanas' => $thanas, 'shifts' => $shifts, 'organizations' => $organizations, 'units' => $units, 'lines' => $lines]);
        }else if($tab == 2){
            $employee = Employee::select('employee_id','id','org_id')->find($id);
            $setting = Setting::active()->first();
            $employee_salary = EmployeeSalary::where('employee_id', $employee->employee_id)->first();
            if ($request->ajax()) {
                return view('hris::database.employee.tab2', ['employee' => $employee, 'tab' => $tab, 'employee_salary' => $employee_salary, 'setting' => $setting]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_salary' => $employee_salary, 'setting' => $setting]);
        }else if($tab == 3){
            $degrees = Degree::active()->pluck('degree', 'id');
            $boards = EducationBoard::active()->pluck('name', 'name');
            $employee = Employee::find($id);
            $employee_education = EmployeeEducation::with('degree')->where('employee_id', $employee->employee_id)->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab3', ['employee' => $employee, 'tab' => $tab, 'degrees' => $degrees, 'boards' => $boards, 'employee_education' => $employee_education]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'degrees' => $degrees, 'boards' => $boards, 'employee_education' => $employee_education]);
        }else if($tab == 4){
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_training = EmployeeTraining::where('employee_id', $employee->employee_id)->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab4', ['employee' => $employee, 'tab' => $tab, 'employee_training' => $employee_training]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_training' => $employee_training]);
        }else if($tab == 5){
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_experience = EmployeeExperience::where('employee_id', $employee->employee_id)->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab5', ['employee' => $employee, 'tab' => $tab, 'employee_experience' => $employee_experience]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_experience' => $employee_experience]);
        }else if($tab == 6){
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_service = EmployeeService::where('employee_id', $employee->employee_id)->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab6', ['employee' => $employee, 'tab' => $tab, 'employee_service' => $employee_service]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_service' => $employee_service]);
        }else if($tab == 7){
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_references = EmployeeReference::where('employee_id', $employee->employee_id)->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab7', ['employee' => $employee, 'tab' => $tab, 'employee_references' => $employee_references]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_references' => $employee_references]);
        }else if($tab == 8){
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_documents = EmployeeDocument::with(['document:id,name'])->where('employee_id', $employee->employee_id)->get();
            $documents = Document::active()->get();
            if ($request->ajax()) {
                return view('hris::database.employee.tab8', ['employee' => $employee, 'tab' => $tab, 'documents' => $documents, 'employee_documents' => $employee_documents]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'documents' => $documents, 'employee_documents' => $employee_documents]);
        }else if($tab == 9){
            $degrees = Degree::active()->pluck('degree', 'id');
            $religions = Religion::active()->pluck('religion', 'religion_code');
            $nationalities = Nationalities::active()->pluck('nationality', 'nl_code');
            $marital_status = MaritalStatus::active()->pluck('maritalstatus', 'ms_code');
            $sex = Sex::active()->pluck('sex', 'sx_code');
            $districts = District::active()->pluck('name', 'id');
            $thanas = Thana::active()->pluck('name', 'id');
            $employee = Employee::select('employee_id','id','org_id','joining_date')->find($id);
            $employee_personal = EmployeePersonal::where('employee_id', $employee->employee_id)->first();
            if ($request->ajax()) {
                return view('hris::database.employee.tab9', ['employee' => $employee, 'tab' => $tab, 'districts' => $districts, 'thanas' => $thanas, 'sex' => $sex, 'nationalities' => $nationalities, 'marital_status' => $marital_status, 'religions' => $religions, 'degrees' => $degrees, 'employee_personal' => $employee_personal]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'districts' => $districts, 'thanas' => $thanas, 'sex' => $sex, 'nationalities' => $nationalities, 'marital_status' => $marital_status, 'religions' => $religions, 'degrees' => $degrees, 'employee_personal' => $employee_personal]);
        }else if($tab == 10){
            $districts = District::active()->pluck('bn_name', 'id');
            $thanas = Thana::active()->pluck('bn_name', 'id');
            $employee = Employee::select('employee_id','id','org_id')->find($id);
            $employee_bangla = EmployeeBangla::where('employee_id', $employee->employee_id)->first();
            if ($request->ajax()) {
                return view('hris::database.employee.tab10', ['employee' => $employee, 'tab' => $tab, 'employee_bangla' => $employee_bangla, 'districts' => $districts, 'thanas' => $thanas]);
            }
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_bangla' => $employee_bangla, 'districts' => $districts, 'thanas' => $thanas]);
        }
    }


    /**
     * Update the specified resource in storage.
     */


    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        DB::beginTransaction();

        try {
            $employeeData = $request->validated();
            $employee->fill($employeeData);

            $hasEmployeeChanges = $employee->isDirty();
            // $employeeBangla = EmployeeBangla::where('employee_id', $employee->employee_id)->first();

            // $banglaData = [
            //     'org_id'                => $employee->org_id,
            //     'name_bangla'           => $employee->name,
            //     'fname_bangla'          => $employee->father_name,
            //     'mname_bangla'          => $employee->mother_name,
            //     'pdistrict_id_bangla'   => $employee->pdistrict_id,
            //     'pthana_id_bangla'      => $employee->pthana_id,
            //     'ppost_office_bangla'   => $employee->ppost_office,
            //     'pvillage_bangla'       => $employee->pvillage,
            //     'mdistrict_id_bangla'   => $employee->mdistrict_id,
            //     'mthana_id_bangla'      => $employee->mthana_id,
            //     'mpost_office_bangla'   => $employee->mpost_office,
            //     'mvillage_bangla'       => $employee->mvillage,
            // ];

            // $hasBanglaChanges = false;

            // if ($employeeBangla) {
            //     $employeeBangla->fill($banglaData);
            //     $hasBanglaChanges = $employeeBangla->isDirty();
            // } else {
            //     $hasBanglaChanges = true;
            // }

            if (!$hasEmployeeChanges) {
                DB::rollBack();
                return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 1])->with('info', 'No changes detected. Nothing was updated.');
            }

            // Now save changes
            if ($hasEmployeeChanges) {
                $employee->updated_by = Auth::id();
                $employee->save();
            }

            // if ($employeeBangla) {
            //     if ($hasBanglaChanges) {
            //         $employeeBangla->updated_by = Auth::id();
            //         $employeeBangla->save();
            //     }
            // } else {
            //     $banglaData['employee_id'] = $employee->employee_id;
            //     $banglaData['created_by'] = Auth::id();
            //     $banglaData['updated_by'] = Auth::id();
            //     EmployeeBangla::create($banglaData);
            // }

            DB::commit();
            return redirect()->route('hris.database.employee.show', ['employee' => $employee->id, 'tab' => 1])->with('success', 'Employee updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Employee Update Error', [
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
            ]);
            return redirect()->back()->with('error', 'Failed to update employee: ' . $th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    public function getThana($district_id) {
        $thanas = Thana::active()->where('district_id', $district_id)->pluck('name', 'id');
        return response()->json($thanas);
    }

    public function getGrade($designation_id) {
        $grades = Designation::select('id','grade')->find($designation_id);
        return response()->json($grades);
    }

    public function getUnit($unit_id) {
        $units = Unit::where('code', $unit_id)->first();
        if($units){
            $lines = array_combine(json_decode($units->line_id), json_decode($units->line));
            return response()->json($lines);
        }else{
            return response()->json(null);
        }
    }

    public function getSearch(Request $request) {
        $search = $request->get('search');
        $employees = Employee::where('employee_id',$search)->first();

        if($employees){
            return redirect()->route('hris.database.employee.show', ['employee' => $employees->id, 'tab' => 1]);
        }else{
            return redirect()->back()->with('error', 'Employee not found');
        }
    }

    public function storeEmployeeBangla(EmployeeBanglaRequest $request){
        try {
            $validated = $request->validated();
            $employee_bangla = EmployeeBangla::where('employee_id', $request->employee_id)->first();
            if($employee_bangla){
                $employee_bangla->fill($validated);
                if ($employee_bangla->isDirty()) {
                    $employee_bangla->update($validated);
                    return redirect()->back()->with('success', 'Employee bangla updated successfully');
                } else {
                    return redirect()->back()->with('info', 'No changes detected');
                }
            }else{
                EmployeeBangla::create($validated);
                return redirect()->back()->with('success', 'Employee bangla saved successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee bangla creation failed: ' . $e->getMessage());
        }
    }

    public function storeEmployeePersonal(EmployeePersonalRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $employee_personal = EmployeePersonal::where('employee_id', $request->employee_id)->first();

            if ($employee_personal) {
                $employee_personal->fill($validated);

                if ($employee_personal->isDirty()) {
                    $employee_personal->update($validated);

                    EmployeeBangla::where('employee_id', $request->employee_id)->update([
                        'nname_bangla'       => $employee_personal->nominee_name,
                        'relation_bangla'    => $employee_personal->relation,
                        'ndistrict_id_bangla'=> $employee_personal->ndistrict_id,
                        'nthana_id_bangla'   => $employee_personal->nthana_id,
                        'npost_office_bangla'=> $employee_personal->npost_office,
                        'nvillage_bangla'    => $employee_personal->nvillage,
                    ]);
                    DB::commit();
                    return redirect()->back()->with('success', 'Employee personal data updated successfully');
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('info', 'No changes detected');
                }
            } else {
                $personal = EmployeePersonal::create($validated);
                if ($personal) {
                    EmployeeBangla::where('employee_id', $request->employee_id)->update([
                        'nname_bangla'       => $personal->nominee_name,
                        'relation_bangla'    => $personal->relation,
                        'ndistrict_id_bangla'=> $personal->ndistrict_id,
                        'nthana_id_bangla'   => $personal->nthana_id,
                        'npost_office_bangla'=> $personal->npost_office,
                        'nvillage_bangla'    => $personal->nvillage,
                    ]);
                }

                DB::commit();
                return redirect()->back()->with('success', 'Employee personal data saved successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::channel('daily')->error('Employee Personal Store Error', [
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
                'trace'   => $th->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Employee personal data creation failed. Please contact admin.');
        }
    }

    public function storeEmployeeDocument(EmployeeDocumentRequest $request)
    {
        try {
            $validated = $request->validated();

            $employee_id = is_array($validated['employee_id']) ? $validated['employee_id'][0] : $validated['employee_id'];
            $new_document_ids = $validated['document_id'];

            if (!is_array($new_document_ids)) {
                $new_document_ids = [$new_document_ids];
            }

            $existingDocuments = EmployeeDocument::where('employee_id', $employee_id)
                ->pluck('document_id')
                ->toArray();

            $documentsToAdd = array_diff($new_document_ids, $existingDocuments);
            $documentsToDelete = array_diff($existingDocuments, $new_document_ids);

            $changesMade = false;

            // Add new documents
            foreach ($documentsToAdd as $document_id) {
                EmployeeDocument::create([
                    'employee_id' => $employee_id,
                    'document_id' => $document_id,
                ]);
                $changesMade = true;
            }

            // Delete removed documents
            if (!empty($documentsToDelete)) {
                EmployeeDocument::where('employee_id', $employee_id)
                    ->whereIn('document_id', $documentsToDelete)
                    ->delete();
                $changesMade = true;
            }

            if ($changesMade) {
                return redirect()->back()->with('success', 'Employee documents updated successfully.');
            } else {
                return redirect()->back()->with('info', 'No changes detected.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update employee documents: ' . $e->getMessage());
        }
    }

    public function storeEmployeeSalary(EmployeeSalaryRequest $request){
        try {
            $validated = $request->validated();
            $employee_salary = EmployeeSalary::where('employee_id', $request->employee_id)->first();
            if($employee_salary){
                $employee_salary->fill($validated);
                $validated['ot_rate'] = round(($validated['basic']/240)*2);
                if ($employee_salary->isDirty()) {
                    $employee_salary->update($validated);
                    return redirect()->back()->with('success', 'Employee salary updated successfully');
                } else {
                    return redirect()->back()->with('info', 'No changes detected');
                }
            }else{
                $validated['ot_rate'] = round(($validated['basic']/240)*2);
                EmployeeSalary::create($validated);
                return redirect()->back()->with('success', 'Employee salary saved successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee salary creation failed: ' . $e->getMessage());
        }
    }

    public function getEmployeeInfo(Request $request){
        $employee = Employee::with(['designation:id,designation','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate'])
                  ->where('employee_id', (int)$request->employee_id)
                  ->select('id','employee_id','name','designation_id','department_id','joining_date','photo')
                  ->first();
        return response()->json($employee);
    }


}
