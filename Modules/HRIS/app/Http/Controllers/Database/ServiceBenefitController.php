<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Database\ServiceBenefit;

class ServiceBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::active()->pluck('short_name', 'id');

        $today = Carbon::now();
        $basedate = $today->day <= 15 ? $today->copy()->startOfMonth()->subMonth() : $today->copy()->startOfMonth();
        $startDate = $basedate->copy()->startOfMonth()->format('Y-m-d');
        $endDate = $basedate->copy()->endOfMonth()->format('Y-m-d');
        $monthYear = $basedate->format('F Y');

        $servicebenfits = ServiceBenefit::with(['employee:id,employee_id,name','department:id,department','designation:id,designation,category_code'])->where('month',$basedate->format('m'))->where('year',$basedate->format('Y'))->orderBy('org_id','asc')->orderBy('employee_id','asc')->get();

        return view('hris::database.servicebenefit.index',compact('organizations','startDate','endDate','monthYear','servicebenfits'));
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
    public function store(Request $request)
    {
        $strdate = Carbon::parse($request->start_date)->format('Y-m-d');
        $enddate = Carbon::parse($request->end_date)->format('Y-m-d');
        $year = (int) Carbon::parse($strdate)->format('Y');
        $month = (int) Carbon::parse($strdate)->format('m');

        DB::beginTransaction();

        try {
            // Simple & clean employee query
            $employeeQuery = Employee::with([
                'department:id,department',
                'designation:id,designation,category_code',
                'employeeSalary:id,employee_id,basic'
            ])
            ->where('org_id', $request->org_id)
            ->whereIn('reason', ['R','T'])
            ->whereBetween('leaving_date', [$strdate, $enddate])
            ->whereRaw('TIMESTAMPDIFF(YEAR, joining_date, leaving_date) >= 3')
            ->when($request->employee_id, fn($q) => $q->where('employee_id', $request->employee_id));

            // Chunk for memory efficiency
            $employeeQuery->chunk(100, function($employeesChunk) use ($strdate, $enddate, $year, $month) {

                // Preload attendance
                $employeeIds = $employeesChunk->pluck('employee_id');
                $attendances = DB::table('payroll_tools_process_attendence')
                    ->whereIn('employee_id', $employeeIds)
                    ->whereNotIn('attn_type', ['LWOP','AB'])
                    ->whereBetween('work_date', [$strdate, $enddate])
                    ->get()
                    ->groupBy('employee_id');

                $rows = [];

                foreach($employeesChunk as $employee) {
                    $payData = $this->calculatePaydays($employee, $attendances);
                    $rate = round(($employee->employeeSalary->basic ?? 0)/30, 2);
                    $amount = round($payData['paydays'] * $rate);

                    $stamp = 0;
                    if($amount >= 500 && $amount < 1000){
                        $stamp = 10;
                    }else if($amount >= 1000 && $amount <= 50000){
                        $stamp = 20;
                    }else if($amount > 50000){
                        $stamp = 50;
                    }
                    $net = $amount-$stamp;

                    $rows[] = [
                        "org_id" => $employee->org_id,
                        "year" => $year,
                        "month" => $month,
                        "employee_id" => $employee->employee_id,
                        "department_id" => $employee->department_id,
                        "designation_id" => $employee->designation_id,
                        "line" => $employee->line,
                        "unit" => $employee->unit,
                        "leaving_date" => $employee->leaving_date,
                        "joining_date" => $employee->joining_date,
                        "paydays" => $payData['paydays'],
                        "basic" => $employee->employeeSalary->basic ?? 0,
                        "rate" => $rate,
                        "amount" => $amount,
                        "stamp" => $stamp,
                        "net_payable" => $net,
                        "for_pay" => 'Y',
                        "status" => 'N',
                        "confirm" => 0,
                        "category" => $employee->designation->category_code ?? null,
                        "reason" => $employee->reason,
                        "created_by" => Auth::id(),
                        "updated_by" => Auth::id()
                    ];
                }
                ServiceBenefit::insert($rows);
            });

            DB::commit();
            return redirect()->back()->with('success', 'Service benefits processed successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Service Benefit Store Error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('hris::show');
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
    public function destroy(Request $request) {
        try {
            $service = ServiceBenefit::findOrFail($request->id);
            if($service->confirm == 1) {
                return response()->json(['success' => false, 'message' => 'Service benefit cannot be deleted as it is confirmed']);
            }
            $service->delete();
            return response()->json(['success' => true, 'message' => 'Service benefit deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Service benefit deletion failed: ' . $e->getMessage()]);
        }
    }


    public function confirm(Request $request)
    {
        $request->validate([
            'org_id'     => 'required',
            'start_date'=> 'required',
            'end_date'  => 'required',
        ]);

        try {
            $orgid = $request->org_id;
            $month = Carbon::parse($request->start_date)->format('m');
            $year  = Carbon::parse($request->start_date)->format('Y');

            ServiceBenefit::where('org_id', $orgid)
                ->where('month', $month)
                ->where('year', $year)
                ->update([
                    'confirm' => 1,
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Service benefit confirmed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service benefit confirmation failed: ' . $e->getMessage()
            ]);
        }
    }

    public function statusUpdate(Request $request) {
        $request->validate([
            'service_id'   => 'required|array|min:1',
            'service_id.*' => 'required|integer|exists:hris_database_service_benefits,id',
            'status'       => 'required|in:Y,N',
        ]);

        try {
            $status = $request->status;
            $servicebenefit_id = $request->service_id;

            ServiceBenefit::whereIn('id', $servicebenefit_id)
                ->update([
                    'status' => $status,
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Service benefit status updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service benefit status update failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Calculate paydays based on joining/leaving dates & attendance
     */
    private function calculatePaydays($employee, $attendances)
    {
        $joining = new Carbon($employee->joining_date);
        $leaving = new Carbon($employee->leaving_date);

        $serviceYears = intval($joining->diffInYears($leaving));
        $basedate = $joining->copy()->addYears($serviceYears)->addDay();

        $presentdays = 0;
        if (isset($attendances[$employee->employee_id])) {
            foreach ($attendances[$employee->employee_id] as $att) {
                if ($att->work_date >= $basedate->format('Y-m-d') && $att->work_date <= $leaving->format('Y-m-d')) {
                    $presentdays++;
                }
            }
        }

        $payPerYear = match (true) {
            $serviceYears >= 10 => 30,
            $serviceYears >= 5  => 15,
            $serviceYears >= 3  => 7,
            default => 0
        };
        $adjustedServiceYears = $serviceYears + ($presentdays >= 240 ? 1 : 0);
        return [
            'paydays' => $adjustedServiceYears * $payPerYear,
            'service_years' => $adjustedServiceYears,
            'present_days' => $presentdays
        ];
    }

}
