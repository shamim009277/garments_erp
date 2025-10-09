<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Database\Advance;
use Modules\Payroll\Models\Tools\AdvanceProcess;
use Modules\Payroll\Http\Requests\Tools\AdvanceProcessRequest;

class AdvanceProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('payroll::tools.advanceprocess.index', compact('organizations', 'month', 'yearlist'));
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
    public function store(AdvanceProcessRequest $request) {
        try {
            if($request->title == 1) {
                $start_date = Carbon::parse($request->year.'-'.$request->month)->startOfMonth()->format('Y-m-d');
            	$end_date = Carbon::parse($request->year.'-'.$request->month)->endOfMonth()->format('Y-m-d');

                $exist = AdvanceProcess::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->first();
                if($exist) {
                    return redirect()->back()->with('error', 'Process Advance Not Possible Because Already Processed');
                }
                $datas = Advance::where('org_id', $request->org_id)->whereBetween('refund_start_date', [$start_date, $end_date])->where('full_refund', 'N')->get();

                $splites = collect($datas)->chunk(100);
                $rows = [];
                $advanceUpdates = [];

                foreach ($splites as $key => $value) {
                    foreach ($value as $key2 => $advance) {
                        $amount = ($advance->balance_amount >= $advance->installment_size)? $advance->installment_size : $advance->balance_amount;

                        $rows[] = [
                            'advance_id'     => $advance->id,
                            'month'          => $request->month,
                            'year'           => $request->year,
                            'org_id'         => $request->org_id,
                            'employee_id'    => $advance->employee_id,
                            'department_id'  => $advance->department_id,
                            'designation_id' => $advance->designation_id,
                            'line_id'        => $advance->line_id,
                            'unit_id'        => $advance->unit_id,
                            'amount'         => $amount,
                            'created_by'     => Auth::id(),
                            'updated_by'     => Auth::id(),
                        ];

                        // ==== advance update collect করি ====
                        if (!isset($advanceUpdates[$advance->id])) {
                            $advanceUpdates[$advance->id] = [
                                'balance_amount' => $advance->balance_amount,
                                'refund_amount'  => $advance->refund_amount,
                                'advance_amount' => $advance->advance_amount,
                            ];
                        }

                        $advanceUpdates[$advance->id]['balance_amount'] -= $amount;
                        $advanceUpdates[$advance->id]['refund_amount']  += $amount;
                    }
                }

                if (!empty($rows)) {
                    AdvanceProcess::insert($rows);
                }

                foreach ($advanceUpdates as $id => $data) {
                    Advance::where('id', $id)->update([
                        'balance_amount' => $data['balance_amount'],
                        'refund_amount'  => $data['refund_amount'],
                        'full_refund'    => ($data['refund_amount'] == $data['advance_amount']) ? 'Y' : 'N',
                    ]);
                }

                return redirect()->back()->with('success', 'Advance Processed Successfully Completed');

            }else if($request->title == 2) {
                $exist = AdvanceProcess::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->where('confirm', 'Y')->first();
                if($exist) {
                    return redirect()->back()->with('error', 'Undo/Revert Not Possible Because Already Confirmed');
                }

                AdvanceProcess::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->delete();

                $lastid = AdvanceProcess::orderBy('id','DESC')->first();
                $lastid = $lastid ? $lastid->id+1 : 1;
                DB::update("ALTER TABLE payroll_tools_process_advance AUTO_INCREMENT = ".$lastid.";");

                return redirect()->back()->with('success', 'Advance Process Reverted Successfully');

            }else if($request->title == 3) {
                $exist = AdvanceProcess::where('org_id', $request->org_id)->where('month', $request->month)->where('year', $request->year)->where('confirm', 'N')->first();
                if(!$exist) {
                    return redirect()->back()->with('error', 'No Data Found For Confirmation');
                }
                AdvanceProcess::where('org_id', $request->org_id)
                    ->where('month', $request->month)
                    ->where('year', $request->year)
                    ->update([
                        'confirm' => 'Y'
                    ]);
                return redirect()->back()->with('success', 'Advance Process Confirmed Successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong '.$th->getMessage());
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
