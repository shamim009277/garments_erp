<?php

namespace Modules\Payroll\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Models\Setup\Organization;
use Modules\Payroll\Models\Tools\ReadMachineData;

class ReadMachineDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = (int)Carbon::parse(Carbon::now())->format('m');
        $organizations = Organization::active()->pluck('short_name', 'id');
        $yearlist = array_combine(range(2025, Carbon::now()->format('Y')), range(2025, Carbon::now()->format('Y')));
        return view('payroll::tools.machinedata.index', compact('organizations', 'month', 'yearlist'));
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
        try {
            $file = $request->file('file');

            if (!$file) {
                return redirect()->back()->with('error', 'No file uploaded!');
            }
            $path = $file->getRealPath();
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // DB query: only compare date part
            DB::table('payroll_tools_read_machinedata')
                ->whereDate('attendance_date', '>=', $request->start_date)
                ->whereDate('attendance_date', '<=', $request->end_date)
                ->delete();

            $lastid = ReadMachineData::orderBy('id','DESC')->first();
            $lastid = $lastid ? $lastid->id+1 : 1;
            DB::update("ALTER TABLE payroll_tools_read_machinedata AUTO_INCREMENT = ".$lastid.";");

            // Chunking for large files
            $chunks = collect($lines)->chunk(1000);

            foreach ($chunks as $chunk) {
                $rows = [];

                foreach ($chunk as $line) {
                    $parts = explode(":", $line);

                    if (count($parts) < 5) {
                        continue;
                    }

                    $machine_no    = $parts[0];
                    $secret_number = $parts[1];
                    $date          = $parts[2];
                    $time          = $parts[3];
                    $punch_type    = $parts[4];

                    // Carbon datetime
                    $attendanceDate = Carbon::createFromFormat('YmdHis', $date.$time)->format('Y-m-d H:i:s');
                    // Map secret_number to employee_id
                    // $employeeId = DB::table('employees')
                    //     ->where('secret_number', $secret_number)
                    //     ->value('id');
                    // if (!$employeeId) {
                    //     continue;
                    // }

                    $rows[] = [
                        'secret_number'   => $secret_number,
                        'employee_id'     => (int)$secret_number,
                        'attendance_date' => $attendanceDate,
                        'machine_number'  => $machine_no,
                        'punch_type'      => $punch_type,
                        'created_by'      => Auth::id(),
                        'updated_by'      => Auth::id(),
                    ];
                }

                if (!empty($rows)) {
                    DB::table('payroll_tools_read_machinedata')->upsert(
                        $rows,
                        ['employee_id', 'attendance_date', 'machine_number', 'punch_type'],
                        ['updated_by', 'updated_at']
                    );
                }
            }
            return redirect()->back()->with('success', 'Machine Data Read Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
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
