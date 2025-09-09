<?php

namespace Modules\HRIS\Http\Controllers\Tools;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRIS\Http\Requests\Tools\CalenderRequest;
use Modules\HRIS\Models\Tools\Calender;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $year = Carbon::now()->year;
        $calender = Calender::whereYear('date', $year)->select('id','date', 'note', 'holiday', 'public_holiday')->get();
        return view('hris::tools.calender.index', compact('year', 'calender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalenderRequest $request) {
        try {

            date_default_timezone_set('Asia/Dhaka');

            $year = $request->year;
            $start_date = Carbon::createFromDate($year, 1, 1);
            $end_date   = Carbon::createFromDate($year, 12, 31);

            $chk = Calender::whereYear('date', $year)->exists();

            if (!$chk) {
                $fixedHolidays = [
                    '02-21' => 'International Mother Language Day',
                    '03-26' => 'Independence And National Day',
                    '04-14' => 'Bengali New Year',
                    '05-01' => 'May Day',
                    '08-15' => 'National Mourning Day',
                    '12-16' => 'Victory Day',
                ];

                $lastid = (Calender::max('id') ?? 0) + 1;
                $rows   = [];

                while ($start_date->lte($end_date)) {
                    $dateKey = $start_date->format('m-d');
                    if (isset($fixedHolidays[$dateKey])) {
                        $naration       = $fixedHolidays[$dateKey];
                        $holiday        = 'Y';
                        $publicholiday  = 'Y';
                    } elseif ($start_date->isFriday()) {
                        $naration       = 'Weekly Holiday';
                        $holiday        = 'Y';
                        $publicholiday  = 'N';
                    } else {
                        $naration       = 'Working Day';
                        $holiday        = 'N';
                        $publicholiday  = 'N';
                    }
                    $rows[] = [
                        'date'           => $start_date->toDateString(),
                        'year'           => (int) $year,
                        'month'          => (int) $start_date->format('m'),
                        'holiday'        => $holiday,
                        'public_holiday' => $publicholiday,
                        'note'           => $naration,
                        'created_by'     => Auth::id(),
                        'updated_by'     => Auth::id(),
                    ];
                    $start_date->addDay();
                }
                Calender::insert($rows);
            }else{
                return redirect()->back()->with('error', 'Calender already exists for this year');
            }
            return redirect()->route('hris.tools.calender.index')->with('success', 'Calender created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create calender: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'note' => 'nullable|string|max:255',
            'holiday' => 'nullable|string|max:50',
            'public_holiday' => 'nullable|string|max:50',
        ]);

        try {
            $calender = Calender::findOrFail($id);
            $calender->fill($validated);
            $calender->save();

            cache()->forget('holidays');
            cache()->remember('holidays', 1440, function () {
                return Calender::where('holiday', 'Y')
                                ->where('year', Carbon::now()->year)
                                ->pluck('date')
                                ->map(fn($date) => $date->format('Y-m-d'))
                                ->toArray();
            });

            return response()->json([
                'success' => true,
                'message' => 'Calender updated successfully',
                'data' => $calender
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update calender: ' . $e->getMessage()
            ], 500);
        }
    }
}
