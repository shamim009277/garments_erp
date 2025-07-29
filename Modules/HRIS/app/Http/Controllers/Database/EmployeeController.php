<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Setup\Sex;
use Illuminate\Support\Facades\Log;
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
use Modules\HRIS\Models\Database\EmployeeDocument;
use Modules\HRIS\Models\Database\EmployeePersonal;
use Modules\HRIS\Models\Database\EmployeeTraining;
use Modules\HRIS\Models\Database\EmployeeEducation;
use Modules\HRIS\Models\Database\EmployeeExperience;
use Modules\HRIS\Http\Requests\Database\EmployeeRequest;
use Modules\HRIS\Http\Requests\Database\EmployeeBanglaRequest;
use Modules\HRIS\Http\Requests\Database\EmployeeDocumentRequest;
use Modules\HRIS\Http\Requests\Database\EmployeePersonalRequest;

class EmployeeController extends Controller
{
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
        $organizations = Organization::active()->pluck('short_name', 'id');
        $applicants = Applicant::with(['department:id,department', 'designation:id,designation'])->active()->fileEntry()->where('entry_date', '>=', $lst_30_days)->where('final_status', 1)->get();
        $unique_department = $applicants->unique('department_id');
        return view('hris::database.employee.index', compact('designations', 'departments', 'districts', 'applicants', 'unique_department', 'shifts', 'organizations'));
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
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        DB::enableQueryLog();

        try {
            // 1. Create employee
            $employeeData = $request->validated();
            $employee = Employee::create($employeeData);

            // 2. Fetch dependent data first
            $empEntryCheck = Applicant::select('determined_salary')->where('employee_id', $employee->employee_id)->first();
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

            // 5. Translate only needed fields
            $translate = new TextTranslateService();
            $employee_bangla_data = [
                'employee_id'           => $employee->employee_id,
                'org_id'                => $employee->org_id,
                'name_bangla'           => $translate->translatePart($employee->name),
                'fname_bangla'          => $translate->translatePart($employee->father_name),
                'mname_bangla'          => $translate->translatePart($employee->mother_name),
                'pdistrict_id_bangla'   => $employee->pdistrict_id,
                'pthana_id_bangla'      => $employee->pthana_id,
                'ppost_office_bangla'   => $translate->translatePart($employee->ppost_office),
                'pvillage_bangla'       => $translate->translatePart($employee->pvillage),
                'mdistrict_id_bangla'   => $employee->mdistrict_id,
                'mthana_id_bangla'      => $employee->mthana_id,
                'mpost_office_bangla'   => $translate->translatePart($employee->mpost_office),
                'mvillage_bangla'       => $translate->translatePart($employee->mvillage),
                'created_by'        => Auth::id(),
                'updated_by'        => Auth::id(),
            ];
            EmployeeBangla::insert($employee_bangla_data);

            DB::commit();
            return redirect()->route('hris.database.employee.show', [
                'employee' => $employee->id,
                'tab' => 1
            ])->with('success', 'Employee created successfully');

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
        if($request->get('tab') == 1){
            $tab = $request->get('tab');
            $employee = Employee::find($id);
            $designations = Designation::active()->pluck('designation', 'id');
            $departments = Department::active()->pluck('department', 'id');

            $districts = District::active()->pluck('name', 'id');
            $thanas = Thana::active()->pluck('name', 'id');
            $shifts = Shift::active()->pluck('shift', 'shift');
            $organizations = Organization::active()->pluck('short_name', 'id');
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'designations' => $designations, 'departments' => $departments, 'districts' => $districts, 'thanas' => $thanas, 'shifts' => $shifts, 'organizations' => $organizations]);
        }else if($request->get('tab') == 2){
            $tab = $request->get('tab');
            $employee = Employee::find($id);
            $employee_salary = EmployeeSalary::where('employee_id', $employee->employee_id)->first();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_salary' => $employee_salary]);
        }else if($request->get('tab') == 3){
            $degrees = Degree::active()->pluck('degree', 'id');
            $boards = EducationBoard::active()->pluck('name', 'name');
            $tab = $request->get('tab');
            $employee = Employee::find($id);
            $employee_education = EmployeeEducation::with('degree')->where('employee_id', $employee->employee_id)->get();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'degrees' => $degrees, 'boards' => $boards, 'employee_education' => $employee_education]);
        }else if($request->get('tab') == 4){
            $tab = $request->get('tab');
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_training = EmployeeTraining::where('employee_id', $employee->employee_id)->get();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_training' => $employee_training]);
        }else if($request->get('tab') == 5){
            $tab = $request->get('tab');
            $employee = Employee::select('employee_id','id')->find($id);
            $employee_experience = EmployeeExperience::where('employee_id', $employee->employee_id)->get();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_experience' => $employee_experience]);
        }else if($request->get('tab') == 6){
            $tab = $request->get('tab');
            $employee = Employee::find($id);
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab]);
        }else if($request->get('tab') == 7){
            $tab = $request->get('tab');
            $employee = Employee::find($id);
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab]);
        }else if($request->get('tab') == 8){
            $tab = $request->get('tab');
            $employee = Employee::select('employee_id','id')->find($id);
            $documents = Document::active()->get();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'documents' => $documents]);
        }else if($request->get('tab') == 9){
            $tab = $request->get('tab');
            $degrees = Degree::active()->pluck('degree', 'id');
            $religions = Religion::active()->pluck('religion', 'religion_code');
            $nationalities = Nationalities::active()->pluck('nationality', 'nl_code');
            $marital_status = MaritalStatus::active()->pluck('maritalstatus', 'ms_code');
            $sex = Sex::active()->pluck('sex', 'sx_code');
            $districts = District::active()->pluck('name', 'id');
            $thanas = Thana::active()->pluck('name', 'id');
            $employee = Employee::select('employee_id','id','org_id','joining_date')->find($id);
            $employee_personal = EmployeePersonal::where('employee_id', $employee->employee_id)->first();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'districts' => $districts, 'thanas' => $thanas, 'sex' => $sex, 'nationalities' => $nationalities, 'marital_status' => $marital_status, 'religions' => $religions, 'degrees' => $degrees, 'employee_personal' => $employee_personal]);
        }else if($request->get('tab') == 10){
            $tab = $request->get('tab');
            $districts = District::active()->pluck('bn_name', 'id');
            $thanas = Thana::active()->pluck('bn_name', 'id');
            $employee = Employee::select('employee_id','id','org_id')->find($id);
            $employee_bangla = EmployeeBangla::where('employee_id', $employee->employee_id)->first();
            return view('hris::database.employee.show', ['employee' => $employee, 'tab' => $tab, 'employee_bangla' => $employee_bangla, 'districts' => $districts, 'thanas' => $thanas]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('hris::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

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

                    $translate = new TextTranslateService();
                    EmployeeBangla::where('employee_id', $request->employee_id)->update([
                        'nname_bangla'       => $translate->translatePart($employee_personal->nominee_name),
                        'relation_bangla'    => $translate->translatePart($employee_personal->relation),
                        'ndistrict_id_bangla'=> $employee_personal->ndistrict_id,
                        'nthana_id_bangla'   => $employee_personal->nthana_id,
                        'npost_office_bangla'=> $translate->translatePart($employee_personal->npost_office),
                        'nvillage_bangla'    => $translate->translatePart($employee_personal->nvillage),
                    ]);
                    DB::commit();
                    return redirect()->back()->with('success', 'Employee personal data updated successfully');
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('info', 'No changes detected');
                }
            } else {
                $personal = EmployeePersonal::create($validated);
                $translate = new TextTranslateService();
                if ($personal) {
                    EmployeeBangla::where('employee_id', $request->employee_id)->update([
                        'nname_bangla'       => $translate->translatePart($personal->nominee_name),
                        'relation_bangla'    => $translate->translatePart($personal->relation),
                        'ndistrict_id_bangla'=> $personal->ndistrict_id,
                        'nthana_id_bangla'   => $personal->nthana_id,
                        'npost_office_bangla'=> $translate->translatePart($personal->npost_office),
                        'nvillage_bangla'    => $translate->translatePart($personal->nvillage),
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

    public function storeEmployeeDocument(EmployeeDocumentRequest $request){
        try {
            $validated = $request->validated();
            $employee_document = EmployeeDocument::where('employee_id', $request->employee_id)->first();
            if($employee_document){
                $employee_document->fill($validated);
                if ($employee_document->isDirty()) {
                    $employee_document->update($validated);
                    return redirect()->back()->with('success', 'Employee document updated successfully');
                } else {
                    return redirect()->back()->with('info', 'No changes detected');
                }
            }else{
                EmployeeDocument::create($validated);
                return redirect()->back()->with('success', 'Employee document saved successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Employee document creation failed: ' . $e->getMessage());
        }
    }


}
