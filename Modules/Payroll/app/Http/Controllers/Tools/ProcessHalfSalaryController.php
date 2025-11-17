<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\MaternityEntry;
use Modules\Payroll\Models\Tools\ProcessSalary;
use Modules\Payroll\Models\Tools\ProcessAttendence;

class ProcessHalfSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('payroll::tools.process-halfsalary.index', compact('organizations', 'month', 'yearlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payroll::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if ($request->title == 1) {

            $exist = ProcessSalary::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->exists();
            if ($exist) {
                return redirect()->back()->with('error', 'Salary already processed for this month and year.');
            }
            $date = $request->date;
            $start_date = Carbon::parse("$date")->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::parse("$date")->format('Y-m-d');
            $year = Carbon::parse("$date")->format('Y');
            $month = Carbon::parse("$date")->format('m');

            // Employees data
            $employees = DB::table('hris_database_employee_basic as basic')
                ->leftJoin('hris_setup_designations as designation', 'designation.id', '=', 'basic.designation_id')
                ->leftJoin('hris_setup_departments as department', 'department.id', '=', 'basic.department_id')
                ->leftJoin('hris_database_employee_salary as salary', 'salary.employee_id', '=', 'basic.employee_id')
                ->where('basic.org_id', $request->org_id)
                ->where('basic.reason', 'N')
                ->where('basic.salaried', 'Y')
                ->where(function ($q) use ($end_date, $start_date) {
                    $q->where('basic.joining_date', '<=', $end_date)
                        ->orWhere(function ($q2) use ($start_date) {
                            $q2->where('basic.leaving_date', '>', $start_date)
                                ->where('basic.salaried', 'Y');
                        });
                })
                ->select('basic.employee_id', 'basic.designation_id', 'basic.department_id', 'basic.line', 'basic.unit', 'basic.grade', 'basic.leaving_date', 'basic.joining_date', 'basic.reason', 'basic.salaried', 'basic.ot_payable', 'designation.category_code', 'salary.*')
                ->get();

            $maternitydata = MaternityEntry::where('org_id', $request->org_id)
                ->where('is_active', 1)
                ->get();
            $hroption = Setting::active()->first();

            // Process in chunks
            foreach ($employees->chunk(250) as $splitemp) {
                $empids = $splitemp->pluck('employee_id')->toArray();
                $attndatas = ProcessAttendence::where('org_id', $request->org_id)
                    ->whereBetween('work_date', [$start_date, $end_date])
                    ->whereIn('employee_id', $empids)
                    ->get();

                foreach ($splitemp as $employee) {
                    $empid = $employee->employee_id;
                    $leavingDate = $employee->leaving_date ? Carbon::parse($employee->leaving_date)->subDay()->format('Y-m-d') : null;
                    $mtReturnDate = !empty($employee->mtreturn_date) && $employee->mtreturn_date > 0 ? Carbon::parse($employee->mtreturn_date)->startOfMonth()->format('Y-m-d') : null;
                    $joiningDate = ($mtReturnDate && $start_date == $mtReturnDate) ? Carbon::parse($employee->mtreturn_date)->addDay()->format('Y-m-d') : $employee->joining_date;

                    $startDate = $start_date;
                    $endDate = $end_date;
                    $attn = [];

                    // Adjust start/end date based on joining/leaving
                    if ($joiningDate > $start_date && $joiningDate <= $end_date && $leavingDate && $leavingDate <= $end_date) {
                        $startDate = $joiningDate;
                        $endDate = $leavingDate;
                    } elseif ($joiningDate > $start_date && $joiningDate <= $end_date) {
                        $startDate = $joiningDate;
                    } elseif ($leavingDate && $leavingDate <= $end_date) {
                        $endDate = $leavingDate;
                    }

                    // Attendance collection
                    $attn = collect($attndatas)
                        ->where('employee_id', $empid)
                        ->filter(fn($item) => $item->work_date >= $startDate && $item->work_date <= $endDate)
                        ->sortBy('work_date')
                        ->values();

                    // Attendance stats
                    $present_days = $attn->whereIn('attn_type', ['PR', 'HD', 'SL', 'CL', 'EL', 'SPL'])->count();
                    $absent_days = $attn->whereIn('attn_type', ['AB', 'ML'])->count();
                    $wpabsent_days = $attn->whereIn('attn_type', ['LWOP'])->count();
                    $leave_days = $attn->whereIn('attn_type', ['SL', 'CL', 'EL', 'ML', 'SPL', 'LWOP'])->count();
                    $realabsent_days = $attn->whereIn('attn_type', ['AB'])->count();

                    $start = Carbon::parse($start_date);
                    $end = Carbon::parse($end_date);

                    // Find difference in days
                    $days = $start->diffInDays($end)+1;

                    $monthdays = $days;
                    $daysinmonth = 30;
                    $total_days = $attn->count();

                    $gwh = $attn->whereIn('attn_type', ['PR', 'HD', 'SL', 'CL', 'EL', 'SPL'])->sum('wwh');
                    $rwh = $attn->whereIn('attn_type', ['PR', 'HD', 'SL', 'CL', 'EL', 'SPL'])->sum('rwh');

                    // All data convert to half
                    $gross_salary = ($employee->gross_salary * $monthdays)/$daysinmonth;
                    $basic = ($employee->basic * $monthdays)/$daysinmonth;
                    $other_allowance = ($employee->other_allowance * $monthdays)/$daysinmonth;
                    $medical_allowance = ($employee->medical_allowance * $monthdays)/$daysinmonth;
                    $food_allowance = ($employee->food_allowance * $monthdays)/$daysinmonth;
                    $conveyance = ($employee->conveyance * $monthdays)/$daysinmonth;
                    $home_allowance = ($employee->home_allowance * $monthdays)/$daysinmonth;

                    // Deductions
                    $wpabdeduct = ($gross_salary / $monthdays) * $wpabsent_days;
                    $abdeduct = ($basic / $daysinmonth) * $absent_days;
                    $shortagehr = ($present_days * 8) - $gwh;
                    $hrdeduct = $shortagehr * ($basic / ($daysinmonth * 8));
                    $basicabdeduct = $wpabdeduct + $abdeduct + $hrdeduct;

                    $oapay = round(($other_allowance / $monthdays) * $present_days);

                    if ($monthdays == $absent_days) {
                        $basicabdeduct = $basic;
                        $oapay = 0;
                    }
                    if ($monthdays == $wpabsent_days) {
                        $basicabdeduct = $gross_salary;
                        $oapay = 0;
                    }

                    $bpayforlong = $bpay = $grpay = 0;
                    if ($joiningDate >= $start_date || $employee->leaving_date > 0) {
                        $bpayforlong = round($basicabdeduct);
                        $grosspay = ($gross_salary / $monthdays) * $total_days;
                        $grpay = round($grosspay + $oapay);
                        $mfcallowance = $medical_allowance + $food_allowance + $conveyance;
                        $bpayable = round(($grosspay - $mfcallowance) / ((100 + $hroption->hr_percent_basic ?? 50) / 100)) - $bpayforlong;
                        $bpay = max($bpayable, 0);
                    } else {
                        $bpayforlong = 0;
                        $bpay = max(round($basic - $basicabdeduct), 0);
                        $grpay = round(($gross_salary + $oapay) - $basicabdeduct);
                    }

                    $deduction = $bpayforlong;
                    $netpayable = ($grpay) - $deduction;
                    $totalnetpayable = ($grpay) - $deduction;

                    // Save ProcessSalary
                    $salarydata = new ProcessSalary();
                    $salarydata->org_id = $employee->org_id;
                    $salarydata->year = $year;
                    $salarydata->month = $month;
                    $salarydata->employee_id = $empid;
                    $salarydata->department_id = $employee->department_id;
                    $salarydata->designation_id = $employee->designation_id;
                    $salarydata->line = $employee->line;
                    $salarydata->unit = $employee->unit;
                    $salarydata->category = $employee->category_code;
                    $salarydata->reason = $employee->reason;
                    $salarydata->grade = $employee->grade;
                    $salarydata->leaving_date = $employee->leaving_date;
                    $salarydata->ot_payable = $employee->ot_payable;
                    $salarydata->salary_from_bank = $employee->salary_from_bank;
                    $salarydata->account_no = $employee->account_no;
                    $salarydata->mobile_banking = $employee->mobile_banking;
                    $salarydata->days = $total_days;
                    $salarydata->absent_days = $absent_days;
                    $salarydata->leave_days = $leave_days;
                    $salarydata->rwh = $rwh;
                    $salarydata->wrh = $gwh;
                    $salarydata->basic = $basic;
                    $salarydata->home_allowance = $home_allowance;
                    $salarydata->medical_allowance = $medical_allowance;
                    $salarydata->food_allowance = $food_allowance;
                    $salarydata->other_allowance = $other_allowance;
                    $salarydata->conveyance = $conveyance;
                    $salarydata->ot_rate = 0;
                    $salarydata->ot_hour = 0;
                    $salarydata->ot_amount = 0;
                    $salarydata->total_ot_hour = 0;
                    $salarydata->total_ot_amount = 0;
                    $salarydata->attendance_bonus = 0;
                    $salarydata->income_tax = 0;
                    $salarydata->advance_amount = 0;
                    $salarydata->advance_refund = 0;
                    $salarydata->other_deduction = 0;
                    $salarydata->absent_deduction = $abdeduct;
                    $salarydata->short_deduction = 0;
                    $salarydata->basic_payable = $bpay;
                    $salarydata->oa_payable = $oapay;
                    $salarydata->gross_payable = $grpay;
                    $salarydata->total_deduction = $deduction;
                    $salarydata->net_payable = $netpayable;
                    $salarydata->total_net_payable = $totalnetpayable;
                    $salarydata->confirm = 'N';
                    $salarydata->created_by = Auth::id();
                    $salarydata->save();
                }
            }
            return redirect()->back()->with('success', 'Salary processed successfully.');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('payroll::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('payroll::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
