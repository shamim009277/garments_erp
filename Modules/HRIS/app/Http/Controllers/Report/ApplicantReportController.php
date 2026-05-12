<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\Applicant;
use Barryvdh\DomPDF\Facade\Pdf;
//
use Dompdf\Options;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Illuminate\Support\Facades\DB;

class ApplicantReportController extends Controller
{
   /*  function __construct()
    {
        $this->middleware('permission:hris.applicant-report.view')->only('index','previewData','preview');
    } */
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

        return view('hris::report.applicant.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }

    public function previewData(){
        return redirect()->route('hris.report.applicant.index');
    }
    public function preview(Request $request){
        if (ob_get_length()) ob_end_clean();

        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1|max:9',
        ]);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $organizations = $request->organizations;
        $parentDepartments = $request->parentDepartments;
        $designations = $request->designations;
        $gatepass_purposes = $request->gatepass_purposes;
        $orgid = $request->organization_id;
        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
            ]);
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,employee_id,entry_date'])
                    ->whereIn('department_id', $request->department_id)
                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->when(
                        $request->filled('start_date') && $request->filled('end_date'),
                        function ($q) use ($startDate, $endDate) {
                            $q->whereHas('applicant', function ($q2) use ($startDate, $endDate) {
                                $q2->whereBetween('entry_date', [$startDate, $endDate]);
                            });
                        }
                    )
                    ->orderBy('employee_id', 'asc')
                    ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations','orgid'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations','orgid'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 2){

            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));

            $employees = Applicant::with(['department', 'designation', 'district'])
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('entry_date', [$start_date, $end_date]);
                })
                ->when($request->filled('designation_id'), function ($q) use ($request) {
                    $q->whereIn('designation_id', $request->designation_id);
                })
                ->orderBy('entry_date', 'asc')
                ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations','orgid'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations','orgid'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 3){
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])

                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('employee_id', 'asc')
                    ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 4){
            $employees = Employee::with(['department:id,department', 'designation:id,designation,category_code', 'organization:id,short_name', 'mdistrict:id,name', 'applicant:id,entry_date'])

                    ->when($request->filled('employee_id'), fn($q) =>
                         $q->where('employee_id', $request->employee_id))
                         ->when($request->filled('category_id'), function ($q) use ($request) {
                            $q->whereHas('designation', function ($q2) use ($request) {
                                $q2->where('category_code', $request->category_id);
                            });
                    })
                    ->when($request->filled('organization_id'), fn($q) =>
                         $q->where('org_id', $request->organization_id))
                    ->when($request->filled('designation_id'), fn($q) =>
                         $q->whereIn('designation_id', $request->designation_id))
                    ->when($request->filled('district_id'), fn($q) =>
                         $q->whereIn('mdistrict.id', $request->district_id))
                    ->orderBy('employee_id', 'asc')
                    ->get();
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');
                $pdf = Pdf::loadView('hris::report.applicant.pdf', compact('employees','title','uniqueDepartments','uniqueDesignations'))
                ->setPaper('a4', 'portrait');

               return $pdf->stream('employee.pdf');
            } 
        }elseif($request->title == 5){
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));
            $employees = Applicant::query()
                ->leftJoin(
                    'hris_database_employee_basic as eb',
                    'eb.employee_id',
                    '=',
                    'hris_database_new_applicant.employee_id'
                )

                ->leftJoin(
                    'hris_setup_lines as sl',
                    DB::raw('COALESCE(eb.line, hris_database_new_applicant.line)'),
                    '=',
                    'sl.id'
                )

                ->leftJoin(
                    'hris_setup_organizations as org',
                    'org.id',
                    '=',
                    'hris_database_new_applicant.org_id'
                )

                ->select(
                    'hris_database_new_applicant.*',
                    DB::raw('COALESCE(eb.line, hris_database_new_applicant.line) as final_line'),
                    'sl.line as line_name',
                    'sl.code as line_code',
                    'org.bn_name as org_bn_name',
                    'org.name as org_name',
                    'org.short_name as org_short_name'
                )

                ->with([
                    'department:id,department_bn',
                    'designation:id,designation_bn',
                    'district',
                ])

                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('entry_date', [$start_date, $end_date]);
                })

                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })

                ->where('final_status', 1)
                ->where('hris_database_new_applicant.employee_id', '!=', 0)
                ->where('hris_database_new_applicant.org_id', $orgid)
                ->whereNotNull('hris_database_new_applicant.employee_id')
                ->orderBy('entry_date', 'asc')
                ->get();


            /* $employees = Applicant::query()
                ->leftJoin('hris_database_employee_basic as eb', 'eb.employee_id', '=', 'hris_database_new_applicant.employee_id')
                ->leftJoin('hris_setup_lines as line', 'line.id', '=', 'eb.line')
                ->select(
                    'hris_database_new_applicant.*',
                    DB::raw('COALESCE(eb.line, hris_database_new_applicant.line) as final_line')
                )
                ->with([
                    'department',
                    'designation',
                    'district',
                    'employee:id,employee_id,line as ln'
                ])
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('entry_date', [$start_date, $end_date]);
                })
                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->where('final_status', 1)
                ->where('hris_database_new_applicant.employee_id', '!=', 0)
                ->whereNotNull('hris_database_new_applicant.employee_id')
                ->orderBy('entry_date', 'asc')
                ->get(); */


            /* $employees = Applicant::with(['department', 'designation', 'district', 'employee:id,employee_id,line as ln'])
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('entry_date', [$start_date, $end_date]);
                })
                ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->where('final_status', 1) 
                ->where('employee_id', '!=', 0) 
                ->whereNotNull('employee_id') 
                ->orderBy('entry_date', 'asc')
                ->orderBy('entry_date', 'asc')
                ->get(); */

           /*  $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));

            $employees = DB::table('hris_database_employee_basic as e')
                ->leftJoin('hris_database_employee_salary as s', 'e.employee_id', '=', 's.employee_id')
                ->leftJoin('hris_database_employee_bangla as b', 'e.employee_id', '=', 'b.employee_id')
                ->leftJoin('hris_setup_departments as d', 'e.department_id', '=', 'd.id')
                ->leftJoin('hris_setup_designations as des', 'e.designation_id', '=', 'des.id')
                ->select(
                    'e.employee_id as emp_id',
                    'e.employee_id',
                    'b.name_bangla',
                    'd.department_bn as department_name',
                    'des.designation_bn as designation_name',
                    's.gross_salary as basic_salary',
                    'e.joining_date',
                    )
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('e.joining_date', [$start_date, $end_date]);
                }) */
            /*   ->when($request->filled('department_id'), function ($q) use ($request) {
                    $q->whereIn('e.department_id', $request->department_id);
                })
                ->when($request->filled('designation_id'), function ($q) use ($request) {
                    $q->whereIn('e.designation_id', $request->designation_id);
                }) */
               /*  ->orderBy('e.joining_date', 'desc')
                ->limit(100)
                ->get(); */
            $uniqueDepartments = $employees->unique('department_id')->pluck('department','department_id');
            $uniqueDesignations = $employees->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;
            if($request->view_mode == 1){
                return view('hris::report.applicant.preview', compact('employees','title','uniqueDepartments','uniqueDesignations'));
            }elseif($request->view_mode == 2){
                 $customPaper = array(52,82);
                ini_set('memory_limit', '2048M');
                ini_set('max_execution_time', '300');

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

                    'autoScriptToLang' => true,
                    'autoLangToFont' => true,
                    'useOTL' => true, 
                ]);

                $html = view('hris::report.applicant.applicantpdf', compact('employees'))->render();
                $mpdf->WriteHTML($html);
                return $mpdf->Output('applicant_id_card.pdf', 'I');
            } 
        }

        return view('hris::report.applicant.preview', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes'));
    }

    public function generateBanglaPDF()
    {
        $data = [
            'employee' => [
                'id' => '000001',
                'name' => 'চয়ন মজুমদার',
                'department' => 'Accounts',
                'designation' => 'Sr. Officer'
            ],
        ];

        $html = view('pdf.employee', compact('data'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font_size' => 11,
            'default_font' => 'notosansbengali',
            'fontDir' => [public_path('fonts')],
            'fontdata' => [
                'notosansbengali' => [
                    'R' => 'NotoSansBengali-Regular.ttf',
                ],
            ],
            'tempDir' => storage_path('app/mpdf-temp'),
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output('employee.pdf', 'I'))
            ->header('Content-Type', 'application/pdf');
    }

    
}
