<?php

namespace Modules\HRIS\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\Applicant;
use Barryvdh\DomPDF\Facade\Pdf;
//
use Carbon\Carbon;
use Dompdf\Options;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Illuminate\Support\Facades\DB;

class AutoGenerationReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $designations = Designation::orderBy('designation', 'asc')->get();
        $gatepass_purposes = EmpGatepassPurpose::pluck('purpose', 'id')->toArray();
        return view('hris::report.autogenerationreport.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }

    public function previewData()
    {
        $employees = Employee::all();
        return view('hris::report.autogenerationreport.preview', compact('employees'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1',
        ]);

        $orgid = $request->organization_id;
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date   = date('Y-m-d', strtotime($request->end_date));
            if($request->title == 1){
                $employees = DB::table('hris_database_employee_basic as e')
                ->leftJoin('hris_database_employee_salary as s', 'e.employee_id', '=', 's.employee_id')
                ->leftJoin('hris_database_employee_bangla as b', 'e.employee_id', '=', 'b.employee_id')
                ->leftJoin('hris_setup_departments as d', 'e.department_id', '=', 'd.id')
                ->leftJoin('hris_setup_designations as des', 'e.designation_id', '=', 'des.id')
                ->leftJoin('hris_setup_thanas as t', 'b.mthana_id_bangla', '=', 't.id')
                ->leftJoin('hris_setup_districts as dis', 'b.mdistrict_id_bangla', '=', 'dis.id')
                ->leftJoin('hris_setup_organizations as org', 'e.org_id', '=', 'org.id')
                ->when($request->filled('organization_id'), function ($q) use ($orgid) {
                    $q->where('e.org_id', $orgid);
                })
                ->select(
                    'e.org_id',
                    'e.employee_id as emp_id',
                    'e.employee_id',
                    'b.name_bangla',
                    'b.fname_bangla',
                    'b.mvillage_bangla',
                    'b.mpost_office_bangla',
                    't.bn_name as thana_name',
                    'dis.bn_name as district_name',
                    'd.department_bn as department_name',
                    'des.designation_bn as designation_name',
                    's.gross_salary as basic_salary',
                    'e.joining_date',
                    'org.bn_name as org_name',
                    )
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('e.joining_date', [$start_date, $end_date]);
                }) 
                ->when($request->filled('employee_id'), function ($q) use ($request) {
                    $ids = is_array($request->employee_id)
                        ? $request->employee_id
                        : [$request->employee_id];

                    $q->whereIn('e.employee_id', $ids);
                })
               ->orderBy('e.joining_date', 'desc')
                ->limit(50)
                ->get(); 
                if ($employees->isEmpty()) {
                    return view('hris::report.autogenerationreport.notfound', [
                        'message' => 'No employee found!'
                    ]);
                }
                    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
                    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];

                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'margin_top' => 10,
                        'margin_bottom' => 10,
                        'margin_left' => 10,
                        'margin_right' => 10,
                        'fontDir' => array_merge($fontDirs, [
                            public_path('fonts'),
                        ]),
                        'fontdata' => $fontData + [
                            'solaimanlipi' => [
                                'R' => 'SolaimanLipi.ttf',
                            ],
                        ],
                        'default_font' => 'solaimanlipi',
                        'tempDir' => storage_path('app/mpdf-temp'),

                        // ✅ এই তিনটি সেটিং বাংলা ঠিক রাখবে:
                        'autoScriptToLang' => true,
                        'autoLangToFont' => true,
                        'useOTL' => true, // এখানে দিও, property নয়!
                    ]);
                
                foreach($employees as $index => $emp){
                    $html = view('hris::report.autogenerationreport.pdf', ['employee' => $emp,'orgid' => $orgid,'title' => $request->title])->render();
                    $mpdf->WriteHTML($html);

                    if ($index != count($employees) - 1) {
                        $mpdf->AddPage(); // নতুন পেজ
                    }
                }

                return $mpdf->Output('joining_letter.pdf', 'I');
            }else if($request->title == 2 || $request->title == 3 || $request->title == 4 || $request->title == 5 || $request->title == 6 || $request->title == 7){
                //Appointment Letter
                $employees = DB::table('hris_database_employee_basic as e')
                    ->leftJoin('hris_database_employee_salary as s', 'e.employee_id', '=', 's.employee_id')
                    ->leftJoin('hris_database_employee_bangla as b', 'e.employee_id', '=', 'b.employee_id')
                    ->leftJoin('hris_database_employee_personal as p', 'e.employee_id', '=', 'p.employee_id')
                    ->leftJoin('hris_setup_departments as d', 'e.department_id', '=', 'd.id')
                    ->leftJoin('hris_setup_designations as des', 'e.designation_id', '=', 'des.id')
                    ->leftJoin('hris_setup_thanas as t', 'b.mthana_id_bangla', '=', 't.id')
                    ->leftJoin('hris_setup_thanas as t_p', 'b.pthana_id_bangla', '=', 't_p.id')
                    ->leftJoin('hris_setup_thanas as t_n', 'b.nthana_id_bangla', '=', 't_n.id')
                    ->leftJoin('hris_setup_districts as dis', 'b.mdistrict_id_bangla', '=', 'dis.id')
                    ->leftJoin('hris_setup_districts as dis_p', 'b.pdistrict_id_bangla', '=', 'dis_p.id')
                    ->leftJoin('hris_setup_districts as dis_n', 'b.ndistrict_id_bangla', '=', 'dis_n.id')
                    ->leftJoin('hris_setup_organizations as org', 'e.org_id', '=', 'org.id')
                    ->when($request->filled('organization_id'), function ($q) use ($orgid) {
                        $q->where('e.org_id', $orgid);
                    })
                    ->select(
                        'e.employee_id as emp_id',
                        'e.employee_id',
                        'e.joining_date',
                        'e.grade',
                        'e.line',
                        'e.ot_payable',
                        'b.name_bangla',
                        'b.fname_bangla',
                        'b.mname_bangla',
                        'b.mvillage_bangla',
                        'b.pvillage_bangla',
                        'b.mpost_office_bangla',
                        'b.ppost_office_bangla',
                        'b.relation_bangla',
                        'b.identification',
                        'b.nname_bangla',
                        'b.nmobile_number',
                        'b.nvillage_bangla',
                        'b.npost_office_bangla',
                        'b.nominee_relation',
                        'p.mobile',
                        'p.national_id',
                        'p.birth_certificate',
                        'p.birth_date',
                        'p.sex_code',
                        't.bn_name as thana_name',
                        't_p.bn_name as thana_name_p',
                        't_n.bn_name as thana_name_n',
                        'dis.bn_name as district_name',
                        'dis_p.bn_name as district_name_p',
                        'dis_n.bn_name as district_name_n',
                        'd.department_bn as department_name',
                        'des.designation_bn as designation_name',
                        's.gross_salary as basic_salary',
                        's.basic',
                        's.home_allowance',
                        's.medical_allowance',
                        's.conveyance',
                        's.food_allowance',
                        'e.leaving_date',
                    )
                    ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                        $q->whereBetween('e.joining_date', [$start_date, $end_date]);
                    }) 
                    ->when($request->filled('employee_id'), function ($q) use ($request) {
                        $ids = is_array($request->employee_id)
                            ? $request->employee_id
                            : [$request->employee_id];

                        $q->whereIn('e.employee_id', $ids);
                    })
                    ->orderBy('e.joining_date', 'desc')
                    ->limit(50)
                    ->get(); 
                    $todayBn       = bnNumber(date('d/m/Y'));
                    if ($employees->isEmpty()) {
                        return view('hris::report.autogenerationreport.notfound', [
                            'message' => 'No employee found! may be date range , employee id or organization some information is incorrect.'
                        ]);
                    }
                    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
                    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];

                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'margin_top' => 10,
                        'margin_bottom' => 10,
                        'margin_left' => 10,
                        'margin_right' => 10,
                        'fontDir' => array_merge($fontDirs, [
                            public_path('fonts'),
                        ]),
                        'fontdata' => $fontData + [
                            'solaimanlipi' => [
                                'R' => 'SolaimanLipi.ttf',
                            ],
                        ],
                        'default_font' => 'solaimanlipi',
                        'tempDir' => storage_path('app/mpdf-temp'),

                        // ✅ এই তিনটি সেটিং বাংলা ঠিক রাখবে:
                        'autoScriptToLang' => true,
                        'autoLangToFont' => true,
                        'useOTL' => true, // এখানে দিও, property নয়!
                    ]);
                    // Inside your controller loop:
                    if($request->title == 6){
                        $employees = $employees->values();
                        if ($employees->count() == 0) {
                            return back()->with('error', 'No data found');
                        }

                        $chunks = $employees->chunk(2);

                        foreach ($chunks as $index => $employeeChunk) {

                            if ($index > 0) {
                                $mpdf->AddPage();   // 🔥 এই লাইনটাই missing ছিল
                            }

                            $html = view('hris::report.autogenerationreport.pdf', [
                                'employeeChunk' => $employeeChunk,
                                'title' => 6, 'orgid' => $orgid, 'todayBn' => $todayBn
                            ])->render();

                            $mpdf->WriteHTML($html);
                        }

                        return $mpdf->Output('salary-slip.pdf', 'I');

                    }

                
                /* $html = view('hris::report.autogenerationreport.pdf', compact('employees'))->render();
                $mpdf->WriteHTML($html);
                return $mpdf->Output('joining_letter.pdf', 'I'); */
                foreach($employees as $index => $emp){
                    $html = view('hris::report.autogenerationreport.pdf', ['employee' => $emp,'orgid' => $orgid,'title' => $request->title, 'todayBn' => $todayBn])->render();
                    $mpdf->WriteHTML($html);

                    if ($index != count($employees) - 1) {
                        $mpdf->AddPage(); // নতুন পেজ
                    }
                }

                return $mpdf->Output('autogeneration.pdf', 'I');
            }else if($request->title == 8 || $request->title == 9){
                
                $employees = DB::table('hris_database_employee_basic as e')
                ->leftJoin('hris_database_employee_salary as s', 'e.employee_id', '=', 's.employee_id')
                ->leftJoin('hris_database_employee_bangla as b', 'e.employee_id', '=', 'b.employee_id')
                ->leftJoin('hris_setup_departments as d', 'e.department_id', '=', 'd.id')
                ->leftJoin('hris_setup_designations as des', 'e.designation_id', '=', 'des.id')
                ->leftJoin('hris_setup_thanas as t', 'b.mthana_id_bangla', '=', 't.id')
                ->leftJoin('hris_setup_districts as dis', 'b.mdistrict_id_bangla', '=', 'dis.id')
                ->leftJoin('hris_setup_organizations as org', 'e.org_id', '=', 'org.id')
                ->when($request->filled('organization_id'), function ($q) use ($orgid) {
                    $q->where('e.org_id', $orgid);
                })
                ->select(
                    'e.org_id',
                    'e.employee_id as emp_id',
                    'e.employee_id',
                    'b.name_bangla',
                    'b.fname_bangla',
                    'b.mvillage_bangla',
                    'b.mpost_office_bangla',
                    't.bn_name as thana_name',
                    'dis.bn_name as district_name',
                    'd.department_bn as department_name',
                    'des.designation_bn as designation_name',
                    's.gross_salary as basic_salary',
                    'e.joining_date',
                    'e.line',
                    'org.bn_name as org_name',
                    )
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('e.joining_date', [$start_date, $end_date]);
                }) 
                ->when($request->filled('employee_id'), function ($q) use ($request) {
                    $ids = is_array($request->employee_id)
                        ? $request->employee_id
                        : [$request->employee_id];

                    $q->whereIn('e.employee_id', $ids);
                })
               ->orderBy('e.joining_date', 'desc')
                ->limit(50)
                ->get(); 
                if ($employees->isEmpty()) {
                    return view('hris::report.autogenerationreport.notfound', [
                        'message' => 'No employee found!'
                    ]);
                }
                    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
                    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];
                    $customPaper = array(49,76);
                    // For ID card (title 8), no margins to fit exactly on the card
                    $isIdCard = ($request->title == 8 || $request->title == 9);
                    $mpdf = new \Mpdf\Mpdf([
                        'mode' => 'utf-8',
                        'format' => $customPaper,
                        'margin_top' => $isIdCard ? 0 : 10,
                        'margin_bottom' => $isIdCard ? 0 : 10,
                        'margin_left' => $isIdCard ? 0 : 10,
                        'margin_right' => $isIdCard ? 0 : 10,
                        'fontDir' => array_merge($fontDirs, [
                            public_path('fonts'),
                        ]),
                        'fontdata' => $fontData + [
                            'solaimanlipi' => [
                                'R' => 'SolaimanLipi.ttf',
                                'B'  => 'SolaimanLipi.ttf',
                            ],
                        ],
                        'default_font' => 'solaimanlipi',
                        'tempDir' => storage_path('app/mpdf-temp'),

                        // ✅ এই তিনটি সেটিং বাংলা ঠিক রাখবে:
                        'autoScriptToLang' => true,
                        'autoLangToFont' => true,
                        'useOTL' => true, // এখানে দিও, property নয়!
                    ]);
                
                foreach($employees as $index => $emp){
                    $html = view('hris::report.autogenerationreport.pdf', ['employee' => $emp,'orgid' => $orgid,'title' => $request->title])->render();
                    $mpdf->WriteHTML($html);

                    // For ID card (title 8), front and back are already separated by page-break in template
                    // For other titles, add new page between employees
                    if ($index != count($employees) - 1 && $request->title != 8) {
                        $mpdf->AddPage(); // নতুন পেজ
                    }
                }

                return $mpdf->Output('joining_letter.pdf', 'I');
            }
            

    }

   
}
