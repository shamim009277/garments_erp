<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRIS\Models\Database\EmployeeIncrement;
use Modules\HRIS\Models\Setting;
use Modules\HRIS\Models\Setup\Organization;
use Modules\HRIS\Models\Tools\MaternityEntry;
use Modules\Payroll\Models\Tools\ProcessAttendence;
use Modules\Payroll\Models\Tools\ProcessSalary;
use Modules\Payroll\Models\Tools\PunchData;


class ProcessSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));

        return view('payroll::tools.processsalary.index', compact('organizations', 'month', 'yearlist'));
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
    public function store(Request $request)
    {
        if ($request->title == 1) {
            set_time_limit(0);
            ini_set('memory_limit', '2048M');

            $exist = ProcessSalary::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->exists();
            if ($exist) {
                return redirect()->back()->with('error', 'Salary already processed for this month and year.');
            }
            $month = $request->month;
            $year = $request->year;
            $start_date = Carbon::parse("$year-$month-01")->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::parse("$year-$month-01")->endOfMonth()->format('Y-m-d');

            //dd($start_date, $end_date);

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
                ->select('basic.employee_id','basic.shifting_duty','basic.refrerence_shift', 'basic.designation_id', 'basic.department_id', 'basic.line', 'basic.unit', 'basic.grade', 'basic.leaving_date', 'basic.joining_date', 'basic.reason', 'basic.salaried', 'basic.ot_payable', 'designation.category_code', 'salary.*')
                ->get();

            $incrementdata = EmployeeIncrement::query()
                ->where('org_id', $request->org_id)
                ->whereBetween('increment_date', [$start_date, $end_date])
                ->whereDate('effective_date', '<', $start_date)
                ->active()
                ->enforce()
                ->notDiscard()
                ->get();

            // Advances, punishments, maternity, HR options
            $advances = DB::table('payroll_tools_process_advance as advance')
                ->leftJoin('payroll_database_advance as databaseadvance', 'databaseadvance.id', '=', 'advance.advance_id')
                ->where('advance.org_id', $request->org_id)
                ->where('advance.month', $month)
                ->where('advance.year', $year)
                ->where('advance.is_active', 1)
                ->where('advance.confirm', 'Y')
                ->select('advance.*', 'databaseadvance.advance_amount')
                ->get();

            $departmentid = $employees->unique('department_id')->pluck('department_id')->toArray();
            $punishments = DB::table('payroll_database_punishment as punishment')
                ->whereBetween('punishment.punishment_date', [$start_date, $end_date])
                ->where('punishment.is_active', 1)
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

                $areardata = $incrementdata->whereIn('employee_id', $empids)->toArray();

                foreach ($splitemp as $employee) {
                    $empid = $employee->employee_id;
                    $leavingDate = $employee->leaving_date ? Carbon::parse($employee->leaving_date)->subDay()->format('Y-m-d') : null;
                    $mtReturnDate = !empty($employee->mtreturn_date) && $employee->mtreturn_date > 0 ? Carbon::parse($employee->mtreturn_date)->startOfMonth()->format('Y-m-d') : null;
                    $joiningDate = ($mtReturnDate && $start_date == $mtReturnDate) ? Carbon::parse($employee->mtreturn_date)->addDay()->format('Y-m-d') : $employee->joining_date;

                    $startDate = $start_date;
                    $endDate = $end_date;
                    $attnBns = 'Y';
                    $attn = [];
                    $arear = 0;

                    // Area increment
                    $areaIncrement = collect($areardata)->where('employee_id', $empid)->first();
                    if ($areaIncrement) {
                        $effDate   = Carbon::parse($areaIncrement['effective_date']);
                        $arrerDate = Carbon::parse($areaIncrement['arrear_upto_date']);
                        $arrmonths = round($effDate->diffInMonths($arrerDate));
                        $arear = $arrmonths * $areaIncrement['amount'];
                    }

                    // Adjust start/end date based on joining/leaving
                    if ($joiningDate > $start_date && $joiningDate <= $end_date && $leavingDate && $leavingDate <= $end_date) {
                        $startDate = $joiningDate;
                        $endDate = $leavingDate;
                        $attnBns = 'N';
                    } elseif ($joiningDate > $start_date && $joiningDate <= $end_date) {
                        $startDate = $joiningDate;
                        $attnBns = 'N';
                    } elseif ($leavingDate && $leavingDate <= $end_date) {
                        $endDate = $leavingDate;
                        $attnBns = 'N';
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
                    $late_days = $attn->where('is_late', 'Y')->where('attn_type', '!=', 'HD')->count();
                    $holiday_days = $attn->where('attn_type', 'HD')->count();

                    $monthdays = Carbon::parse("$year-$month-01")->daysInMonth;
                    $daysinmonth = 30;
                    $total_days = $attn->count();

                    $gwh = $attn->whereIn('attn_type', ['PR', 'HD', 'SL', 'CL', 'EL', 'SPL'])->sum('wwh');
                    $rwh = $attn->whereIn('attn_type', ['PR', 'HD', 'SL', 'CL', 'EL', 'SPL'])->sum('rwh');

                    // Attendance bonus
                    $attn_bonus = 0;
                    if ($employee->attendance_bonus > 0) {
                        $islate = $attn->where('is_late', 'Y')->where('attn_type', '!=', 'HD')->count();
                        if ($attnBns == 'N' || $realabsent_days > 0 || $islate > 0) {
                            $attn_bonus = 0;
                        } else {
                            $attn_bonus = $employee->attendance_bonus;
                        }
                    }

                    // Shifting duty
                    $duration = ($employee->shifting_duty == 'Y' && ($employee->refrerence_shift == 'N' || $employee->shifting_duty == 'M')) ? 11 : 8;
                    $hour = ($employee->shifting_duty == 'Y' && ($employee->refrerence_shift == 'N' || $employee->shifting_duty == 'M')) ? 286 : 208;

                    // OT calculation
                    $totalothour = $attn->sum('ot_hours');
                    $othr = $attn->sum(function ($a) {
                        if ($a->attn_type == 'HD') return 0;
                        return min($a->ot_hours, 2);
                    });

                    $othour = ($employee->ot_payable == 'Y') ? $othr : 0;
                    $otrate = round(($employee->basic / $hour) * 2, 2);
                    $otamount = round($otrate * $othour);
                    $totalotamount = round($otrate * $totalothour);

                    // Advances / punishments
                    $advamount = $advances->where('employee_id', $empid)->sum('advance_amount');
                    $advrefund = $advances->where('employee_id', $empid)->sum('amount');
                    $punish = $punishments->where('employee_id', $empid)->count();

                    // Deductions
                    $wpabdeduct = ($employee->gross_salary / $monthdays) * $wpabsent_days;
                    $abdeduct = ($employee->basic / $daysinmonth) * $absent_days;
                    $punishdeduct = ($employee->basic / $daysinmonth) * $punish;
                    $shortagehr = ($present_days * $duration) - $gwh;
                    $hrdeduct = $shortagehr * ($employee->basic / ($daysinmonth * $duration));
                    $basicabdeduct = $wpabdeduct + $abdeduct + $hrdeduct + $punishdeduct;
                    $oapay = round(($employee->other_allowance / $monthdays) * $present_days);

                    if ($monthdays == $absent_days) {
                        $basicabdeduct = $employee->basic;
                        $oapay = 0;
                    }
                    if ($monthdays == $wpabsent_days) {
                        $basicabdeduct = $employee->gross_salary;
                        $oapay = 0;
                    }

                    $bpayforlong = $bpay = $grpay = 0;
                    if ($joiningDate >= $start_date || $employee->leaving_date > 0) {
                        $bpayforlong = round($basicabdeduct);
                        $grosspay = ($employee->gross_salary / $monthdays) * $total_days;
                        $grpay = round($grosspay + $oapay + $attn_bonus);
                        $mfcallowance = $employee->medical_allowance + $employee->food_allowance + $employee->conveyance;
                        $bpayable = round(($grosspay - $mfcallowance) / ((100 + $hroption->hr_percent_basic ?? 50) / 100)) - $bpayforlong;
                        $bpay = max($bpayable, 0);
                    } else {
                        $bpayforlong = 0;
                        $bpay = max(round($employee->basic - $basicabdeduct), 0);
                        $grpay = round(($employee->gross_salary + $oapay + $attn_bonus) - $basicabdeduct);
                    }

                    $deduction = $advrefund + $employee->tax + $bpayforlong;
                    $totaldeduction = round($advrefund + $employee->tax + $bpayforlong + $wpabdeduct + $abdeduct + $hrdeduct + $punishdeduct);
                    $netpayable = ($grpay + $otamount + $arear) - $deduction;
                    $totalnetpayable = ($grpay + $totalotamount + $arear) - $deduction;

                    // Required field check
                    $requiredFields = [
                        $employee->org_id,
                        $year,
                        $month,
                        $empid,
                        $employee->department_id,
                        $employee->designation_id,
                        $employee->basic,
                        $employee->gross_salary,
                        $employee->category_code,
                    ];

                    $hasMissingData = collect($requiredFields)->contains(function ($value) {
                        return is_null($value) || $value === '' || $value === 'Nil' || $value === '0' || $value === 0;
                    });

                    // Skip employee if data missing
                    if ($hasMissingData) {
                        continue;
                    }

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
                    $salarydata->leaving_date = $leavingDate = ($employee->leaving_date == "0000-00-00") ? null : $employee->leaving_date;
                    $salarydata->ot_payable = $employee->ot_payable;
                    $salarydata->salary_from_bank = $employee->salary_from_bank;
                    $salarydata->account_no = $employee->account_no;
                    $salarydata->mobile_banking = $employee->mobile_banking;
                    $salarydata->days = $total_days;
                    $salarydata->absent_days = $absent_days;
                    $salarydata->leave_days = $leave_days;
                    $salarydata->late_days = $late_days;
                    $salarydata->weekend_days = $holiday_days;
                    $salarydata->general_holiday_days = 0;
                    $salarydata->rwh = $rwh;
                    $salarydata->wrh = $gwh;
                    $salarydata->basic = $employee->basic;
                    $salarydata->home_allowance = $employee->home_allowance;
                    $salarydata->medical_allowance = $employee->medical_allowance;
                    $salarydata->food_allowance = $employee->food_allowance;
                    $salarydata->other_allowance = $employee->other_allowance;
                    $salarydata->conveyance = $employee->conveyance;
                    $salarydata->ot_rate = round($otrate);
                    $salarydata->ot_hour = $othour;
                    $salarydata->ot_amount = round($otamount);
                    $salarydata->total_ot_hour = $totalothour;
                    $salarydata->total_ot_amount = round($totalotamount);
                    $salarydata->attendance_bonus = $attn_bonus;
                    $salarydata->income_tax = $employee->tax;
                    $salarydata->advance_amount = $advamount;
                    $salarydata->advance_refund = $advrefund;
                    $salarydata->other_deduction = 0;
                    $salarydata->absent_deduction = round($abdeduct);
                    $salarydata->short_deduction = 0;
                    $salarydata->basic_payable = $bpay;
                    $salarydata->oa_payable = $oapay;
                    $salarydata->arear_amount = $arear;
                    $salarydata->gross_payable = $grpay;
                    $salarydata->total_deduction = $totaldeduction;
                    $salarydata->net_payable = $netpayable;
                    $salarydata->total_net_payable = $totalnetpayable;
                    $salarydata->confirm = 'N';
                    $salarydata->created_by = Auth::id();
                    $salarydata->save();
                }
            }
            return redirect()->back()->with('success', 'Salary processed successfully.');
        } else if ($request->title == 2) {
            $month = $request->month;
            $year  = $request->year;

            $startTime = microtime(true);
            $exists = ProcessSalary::where('month', $month)
                ->where('year', $year)
                ->where('org_id', $request->org_id)
                ->exists();

            if ($exists) {
                $deletedCount = ProcessSalary::where('month', $month)
                    ->where('year', $year)
                    ->where('org_id', $request->org_id)
                    ->count();

                ProcessSalary::where('month', $month)
                    ->where('year', $year)
                    ->where('org_id', $request->org_id)
                    ->delete();

                $lastId = DB::table('payroll_tools_process_salary')->max('id') ?? 0;
                $newAutoIncrement = $lastId + 1;
                DB::statement("ALTER TABLE payroll_tools_process_salary AUTO_INCREMENT = {$newAutoIncrement}");

                $executionTime = round(microtime(true) - $startTime, 3);

                return redirect()->back()->with('success', "✅ Salary Process deleted successfully." . "Total deleted rows: {$deletedCount}" . "Time taken: {$executionTime} seconds");
            } else {
                return redirect()->back()->with('error', 'No salary data found for this month/year.');
            }
        } else if ($request->title == 3) {
            $month = $request->month;
            $year  = $request->year;

            $startTime = microtime(true);
            $exists = ProcessSalary::where('month', $month)
                ->where('year', $year)
                ->where('org_id', $request->org_id)
                ->exists();

            if ($exists) {
                ProcessSalary::where('month', $month)
                    ->where('year', $year)
                    ->where('org_id', $request->org_id)
                    ->update([
                        'confirm' => 'Y',
                    ]);

                return redirect()->back()->with('success', "✅ Salary Process confirmed successfully.");
            } else {
                return redirect()->back()->with('error', 'No salary data found for this month/year.');
            }
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
