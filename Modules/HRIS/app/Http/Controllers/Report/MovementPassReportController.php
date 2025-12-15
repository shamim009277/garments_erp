<?php

namespace Modules\HRIS\Http\Controllers\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Setup\Designation;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Setup\EmployeeCategory;
use Modules\HRIS\Models\Setup\ParentDepartment;
use Modules\HRIS\Models\Setup\EmpGatepassPurpose;
use Modules\HRIS\Models\Database\EmpGatePass;
use Modules\HRIS\Models\Database\Employee;

use Barryvdh\DomPDF\Facade\Pdf;

class MovementPassReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.movement-pass.view')->only('index','previewData','preview');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $organizations = Organization::pluck('short_name', 'id');
        $parentDepartments = ParentDepartment::with('departments')->whereHas('departments') ->orderBy('department', 'asc') ->get();
        $designations = Designation::orderBy('designation', 'asc')->get();
        $gatepass_purposes = EmpGatepassPurpose::pluck('purpose', 'id')->toArray();
        $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
        $currentMonth = now()->month;

        return view('hris::report.movementpass.index', compact('startDate', 'endDate', 'organizations', 'parentDepartments', 'designations', 'gatepass_purposes','months','currentMonth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function previewData(){
        return redirect()->route('hris.report.movementpass-report.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'employee_id' => 'nullable|numeric|min:6',
            'view_mode' => 'required|string|min:1|max:1',
            'organization_id' => 'required|integer|min:1',
        ]);
        $orgid = $request->organization_id;

        if($request->title == 1){
            $request->validate([
                'department_id' => 'required|array',
            ]);

            $datas = EmpGatePass::with([
                    'employee:id,employee_id,name,org_id,department_id,designation_id',
                    'employee.organization:id,short_name',
                    'department:id,department',
                    'designation:id,designation',
                    'reason:id,reason',
                    'approvedBy:id,name'
                ])
                ->whereMonth('date', $request->month)
                ->when($request->department_id, function($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->when($request->employee_id, function($q) use ($request) {
                    $q->where('employee_id', $request->employee_id);
                })
                ->when($request->purpose_id, function($q) use ($request) {
                    $q->where('purpose_id', $request->purpose_id);
                })
                ->whereHas('employee', function ($q) use ($orgid) {
                    $q->where('org_id', $orgid);
                })
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department','department_id');
            $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            $title = $request->title;
            $month = $request->month;

            if($request->view_mode == 1){
                return view('hris::report.movementpass.preview', compact('datas','title','uniqueDepartments','orgid','months','month',));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.movementpass.pdf', compact('datas','title','uniqueDepartments','orgid','months','month'))->setPaper('a4', 'landscape');
                return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 2){
            $request->validate([
                'designation_id' => 'required|array',
            ]);

            $datas = EmpGatePass::with([
                    'employee:id,employee_id,name,org_id,department_id,designation_id',
                    'employee.organization:id,short_name',
                    'department:id,department',
                    'designation:id,designation',
                    'reason:id,reason',
                    'approvedBy:id,name'
                ])
                ->whereMonth('date', $request->month)
                ->when($request->designation_id, function($q) use ($request) {
                    $q->whereIn('designation_id', $request->designation_id);
                })
                ->when($request->employee_id, function($q) use ($request) {
                    $q->where('employee_id', $request->employee_id);
                })
                ->when($request->purpose_id, function($q) use ($request) {
                    $q->where('purpose_id', $request->purpose_id);
                })
                ->whereHas('employee', function ($q) use ($orgid) {
                    $q->where('org_id', $orgid);
                })
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueDesignations = $datas->unique('designation_id')->pluck('designation','designation_id');
            $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
            $title = $request->title;
            $month = $request->month;

            if($request->view_mode == 1){
                return view('hris::report.movementpass.preview', compact('datas','title','uniqueDesignations','orgid','months','month'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.movementpass.pdf', compact('datas','title','uniqueDesignations','orgid','months','month'))->setPaper('a4', 'landscape');
                return $pdf->stream('employee.pdf');
            }
        }elseif($request->title == 3){
            $request->validate([
                'department_id' => 'required|array',
            ]);

            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));

            $datas = EmpGatePass::with([
                    'employee:id,employee_id,name,org_id,department_id,designation_id',
                    'employee.organization:id,short_name',
                    'department:id,department',
                    'designation:id,designation',
                    'reason:id,reason',
                    'approvedBy:id,name',
                    'purpose:id,purpose'
                ])
                ->whereBetween('date', [$start_date, $end_date])
                ->when($request->department_id, function($q) use ($request) {
                    $q->whereIn('department_id', $request->department_id);
                })
                ->when($request->employee_id, function($q) use ($request) {
                    $q->where('employee_id', $request->employee_id);
                })
                ->when($request->purpose_id, function($q) use ($request) {
                    $q->where('purpose_id', $request->purpose_id);
                })
                ->whereHas('employee', function ($q) use ($orgid) {
                    $q->where('org_id', $orgid);
                })
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueDepartments = $datas->unique('department_id')->pluck('department','department_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.movementpass.preview', compact('datas','title','uniqueDepartments','start_date','end_date','orgid'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.movementpass.pdf', compact('datas','title','uniqueDepartments','start_date','end_date','orgid'))->setPaper('a4', 'landscape');
                return $pdf->stream('movement_pass_report.pdf');
            }
        }elseif($request->title == 4){
            $request->validate([
                'designation_id' => 'required|array',
            ]);
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date   = date('Y-m-d', strtotime($request->end_date));

            $datas = EmpGatePass::with([
                    'employee:id,employee_id,name,org_id,department_id,designation_id',
                    'employee.organization:id,short_name',
                    'department:id,department',
                    'designation:id,designation',
                    'reason:id,reason',
                    'approvedBy:id,name',
                    'purpose:id,purpose'
                ])
                ->whereBetween('date', [$start_date, $end_date])
                ->when($request->department_id, function($q) use ($request) {
                    $q->whereIn('designation_id', $request->department_id);
                })
                ->when($request->employee_id, function($q) use ($request) {
                    $q->where('employee_id', $request->employee_id);
                })
                ->when($request->purpose_id, function($q) use ($request) {
                    $q->where('purpose_id', $request->purpose_id);
                })
                ->whereHas('employee', function ($q) use ($orgid) {
                    $q->where('org_id', $orgid);
                })
                ->orderBy('department_id', 'asc')
                ->orderBy('employee_id', 'asc')
                ->get();

            $uniqueDesignations = $datas->unique('designation_id')->pluck('designation','designation_id');
            $title = $request->title;

            if($request->view_mode == 1){
                return view('hris::report.movementpass.preview', compact('datas','title','uniqueDesignations','start_date','end_date','orgid'));
            }elseif($request->view_mode == 2){
                $pdf = Pdf::loadView('hris::report.movementpass.pdf', compact('datas','title','uniqueDesignations','start_date','end_date','orgid'))->setPaper('a4', 'landscape');
                return $pdf->stream('movement.pdf');
            }
        }
    }
}
