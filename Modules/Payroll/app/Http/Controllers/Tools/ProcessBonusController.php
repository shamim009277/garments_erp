<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\ProcessBonus;
use Modules\Payroll\Http\Requests\Tools\ProcessBonusRequest;

class ProcessBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('payroll::tools.processbonus.index', compact('organizations', 'month', 'yearlist'));
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
    public function store(ProcessBonusRequest $request)
    {
        try {
            if ($request->title == 1) {
                $startTime = microtime(true);
                $records = 0;

                $exist = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->first();
                if ($exist) {
                    return redirect()->back()->with('error', 'Process Advance Not Possible Because Already Processed');
                }

                $confirm = ProcessBonus::where('org_id', $request->org_id)->where('confirm', 'N')->first();
                if ($confirm) {
                    return redirect()->back()->with('error', 'Please Confirm Previous Process Advance');
                }

                $start_date = Carbon::parse($request->base_date)->startOfMonth()->format('Y-m-d');
                $end_date = Carbon::parse($request->base_date)->format('Y-m-d');
                
                // Get slab settings (default to 12, 6, 3 months if not provided)
                $slab1_m = $request->input('slab1_months', 12);
                $slab1_p = $request->input('slab1_percent', 100);
                $slab2_m = $request->input('slab2_months', 6);
                $slab2_p = $request->input('slab2_percent', 50);
                $slab3_m = $request->input('slab3_months', 3);
                $slab3_p = $request->input('slab3_percent', 25);

                // Calculate cut-off dates
                $limit1 = Carbon::parse($end_date)->subMonths($slab1_m)->addDays(1)->format('Y-m-d');
                $limit2 = Carbon::parse($end_date)->subMonths($slab2_m)->addDays(1)->format('Y-m-d');
                $limit3 = Carbon::parse($end_date)->subMonths($slab3_m)->addDays(1)->format('Y-m-d');

                $datas = DB::table('hris_database_employee_basic as basic')
                    ->leftJoin('hris_database_employee_salary as salary', 'basic.employee_id', '=', 'salary.employee_id')
                    ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                    ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                    ->where('basic.org_id', $request->org_id)
                    ->whereDate('basic.joining_date', '<=', $limit3)
                    ->where('basic.salaried', 'Y')
                    ->where(function ($q) use ($end_date) {
                        $q->where('basic.reason', 'N')
                            ->orWhere('basic.leaving_date', '>', $end_date);
                    })
                    ->orderBy('basic.employee_id', 'ASC')
                    ->select(
                        'basic.employee_id',
                        'basic.org_id',
                        'basic.name',
                        'basic.department_id',
                        'basic.designation_id',
                        'basic.joining_date',
                        'salary.gross_salary',
                        'salary.basic',
                        'designation.category_code',
                        'basic.line',
                        'basic.unit',
                        'basic.leaving_date',
                    )
                    ->get();

                $splites = collect($datas)->chunk(500);
                $rows = [];
                $base_date = !empty($request->base_date) && strtotime($request->base_date) ? Carbon::parse($request->base_date)->format('Y-m-d') : null;

                foreach ($splites as $key => $value) {
                    foreach ($value as $key2 => $data) {
                        $records++;
                        $percent = 0;
                        $jDate = $data->joining_date;

                        if ($jDate <= $limit1) {
                            $percent = $slab1_p;
                        } elseif ($jDate <= $limit2) {
                            $percent = $slab2_p;
                        } elseif ($jDate <= $limit3) {
                            $percent = $slab3_p;
                        }

                        if ($percent > 0) {
                            $bonus_amount = ($data->basic * $percent) / 100;

                            $rows[] = [
                                'employee_id'    => $data->employee_id,
                                'org_id'         => $data->org_id,
                                'department_id'  => $data->department_id,
                                'designation_id' => $data->designation_id,
                                'joining_date'   => ($data->joining_date && strtotime($data->joining_date)) ? Carbon::parse($data->joining_date)->format('Y-m-d') : null,
                                'leaving_date'   => ($data->leaving_date && strtotime($data->leaving_date)) ? Carbon::parse($data->leaving_date)->format('Y-m-d') : null,
                                'basic'          => $data->basic,
                                'category'       => $data->category_code,
                                'line'           => $data->line,
                                'unit'           => $data->unit,
                                'bonus_type'     => $request->bonus_type,
                                'base_date'      => $base_date,
                                'year'           => $request->year,
                                'gross_salary'   => $data->gross_salary,
                                'amount'         => $bonus_amount,
                                'confirm'        => 'N',
                                'created_by'     => Auth::id(),
                                'updated_by'     => Auth::id(),
                            ];
                        }
                    }
                }

                if (!empty($rows)) {
                    ProcessBonus::insert($rows);
                }
                $executionTime = round(microtime(true) - $startTime, 3);

                Log::info('Process Bonus Execution Time: ' . $executionTime . ' seconds');
                return redirect()->back()->with('success', 'Process Bonus Successfully Completed. Total Records: ' . $records . '. Execution Time: ' . $executionTime . ' seconds');
            } else if ($request->title == 2) {
                $exist = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->where('confirm', 'Y')->first();
                $records = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->count();
                if ($exist) {
                    return redirect()->back()->with('error', 'Undo/Revert Not Possible Because Already Confirmed');
                }
                ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->delete();

                $lastid = ProcessBonus::orderBy('id', 'DESC')->first();
                $lastid = $lastid ? $lastid->id + 1 : 1;
                DB::update("ALTER TABLE payroll_tools_process_bonus AUTO_INCREMENT = " . $lastid . ";");

                return redirect()->back()->with('success', 'Bonus Process Reverted Successfully. Total Records: ' . $records);
            } else if ($request->title == 3) {
                $exist = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->where('confirm', 'N')->first();
                $records = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->count();
                if (!$exist) {
                    return redirect()->back()->with('error', 'No Data Found For Confirmation');
                }
                ProcessBonus::where('org_id', $request->org_id)
                    ->where('year', $request->year)
                    ->where('bonus_type', $request->bonus_type)
                    ->update([
                        'confirm' => 'Y'
                    ]);
                return redirect()->back()->with('success', 'Bonus Process Confirmed Successfully. Total Records: ' . $records);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong ' . $th->getMessage());
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
