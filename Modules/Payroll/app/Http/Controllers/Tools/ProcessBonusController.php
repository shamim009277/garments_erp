<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
                $limit = Carbon::parse($end_date)->subYear(1)->addDays(1)->format('Y-m-d');

                $datas = DB::table('hris_database_employee_basic as basic')
                    ->leftJoin('hris_database_employee_salary as salary', 'basic.employee_id', '=', 'salary.employee_id')
                    ->leftJoin('hris_setup_departments as department', 'basic.department_id', '=', 'department.id')
                    ->leftJoin('hris_setup_designations as designation', 'basic.designation_id', '=', 'designation.id')
                    ->where('basic.org_id', $request->org_id)
                    ->whereDate('basic.joining_date', '<=', $limit)
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

                foreach ($splites as $key => $value) {
                    foreach ($value as $key2 => $data) {
                        $rows[] = [
                            'employee_id'    => $data->employee_id,
                            'org_id'         => $data->org_id,
                            'name'           => $data->name,
                            'department_id'  => $data->department_id,
                            'designation_id' => $data->designation_id,
                            'joining_date'   => $data->joining_date,
                            'gross_salary'   => $data->gross_salary,
                            'basic'          => $data->basic,
                            'category_code'  => $data->category_code,
                            'line'           => $data->line,
                            'unit'           => $data->unit,
                            'leaving_date'   => $data->leaving_date,
                            'org_id'         => $request->org_id,
                            'bonus_type'     => $request->bonus_type,
                            'base_date'      => $request->base_date,
                            'year'           => $request->year,
                            'department_id'  => $data->department_id,
                            'designation_id' => $data->designation_id,
                            'line'           => $data->line,
                            'unit'           => $data->unit,
                            'category'       => $data->category_code,
                            'leaving_date'   => $data->leaving_date,
                            'gross_salary'   => $data->gross_salary,
                            'basic'          => $data->basic,
                            'amount'         => $data->basic,
                            'confirm'        => 'N',
                        ];
                    }
                }

                if (!empty($rows)) {
                    ProcessBonus::insert($rows);
                }

                return redirect()->back()->with('success', 'Process Bonus Successfully Completed');
            } else if ($request->title == 2) {
                $exist = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->where('confirm', 'Y')->first();
                if ($exist) {
                    return redirect()->back()->with('error', 'Undo/Revert Not Possible Because Already Confirmed');
                }

                ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->delete();

                $lastid = ProcessBonus::orderBy('id', 'DESC')->first();
                $lastid = $lastid ? $lastid->id + 1 : 1;
                DB::update("ALTER TABLE payroll_tools_process_bonus AUTO_INCREMENT = " . $lastid . ";");

                return redirect()->back()->with('success', 'Bonus Process Reverted Successfully');
            } else if ($request->title == 3) {
                $exist = ProcessBonus::where('org_id', $request->org_id)->where('year', $request->year)->where('bonus_type', $request->bonus_type)->where('confirm', 'N')->first();
                if (!$exist) {
                    return redirect()->back()->with('error', 'No Data Found For Confirmation');
                }
                ProcessBonus::where('org_id', $request->org_id)
                    ->where('year', $request->year)
                    ->where('bonus_type', $request->bonus_type)
                    ->update([
                        'confirm' => 'Y'
                    ]);
                return redirect()->back()->with('success', 'Bonus Process Confirmed Successfully');
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
