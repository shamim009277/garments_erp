<?php

namespace Modules\SM\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SM\Models\Database\SampleOrderProduction;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\SampleType;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Database\SampleOrderProgramme;
use Modules\HRIS\Models\Setup\Organization;

use Carbon\Carbon;


class SampleProductionReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $sampleTypes = SampleType::where('is_active', 1)->get();
        $samples = SampleOrderProgramme::where('accept_status',1)->with('initialOrder')->get();
        $buyers = collect($samples->pluck('initialOrder.buyer'))->unique('id');
        $organizations = Organization::pluck('short_name', 'id')->toArray();
        return view('sm::report.production.index', compact('buyers', 'sampleTypes','samples','startDate','endDate','organizations'));
    }
    public function preview(Request $request)
    {
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Preview data fetched successfully',
        //     'data' => $request->all()
        // ]);
        // $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        // $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        // $sampleTypes = SampleType::where('is_active', 1)->get();
        // $samples = SampleOrderProgramme::where('accept_status',1)->with('initialOrder')->get();
        $title = $request->title;
        $sampleProductions = SampleOrderProduction::with(['programme','initialOrder','color','size','sampleType'])->whereIn('buyer_id',$request->buyer_id)->get();
        return view('sm::report.production.preview', compact('sampleProductions','title'));

        return response()->json([
            'success' => true,
            'message' => 'Preview data fetched successfully',
            'data' => $sampleProductions
        ]);
        $buyers = collect($samples->pluck('initialOrder.buyer'))->unique('id');
        
        $query = SampleOrderProduction::query();

        if ($request->buyer_id) {
            $query->where('buyer_id', $request->buyer_id);
        }

        if ($request->order_id) {
            $query->where('order_id', $request->order_id);
        }

        if ($request->color_id) {
            $query->where('color_id', $request->color_id);
        }

        if ($request->sample_type_id) {
            $query->where('sample_type_id', $request->sample_type_id);
        }
    }
}