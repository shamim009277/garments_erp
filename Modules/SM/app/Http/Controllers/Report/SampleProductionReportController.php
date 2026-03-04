<?php

namespace Modules\SM\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SM\Models\Database\SampleOrderProduction;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\SampleType;
use Modules\OrderManagement\Models\Database\InitialOrder;

class SampleProductionReportController extends Controller
{
    public function index(Request $request)
    {
        $buyers = Buyer::where('is_active', 1)->get();
        $sampleTypes = SampleType::where('is_active', 1)->get();
        
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
        
        $dateFrom = $request->date_from ? ($request->date_from . ' 00:00:00') : null;
        $dateTo = $request->date_to ? ($request->date_to . ' 23:59:59') : null;

        if ($dateFrom && $dateTo) {
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $query->where('created_at', '>=', $dateFrom);
        } elseif ($dateTo) {
            $query->where('created_at', '<=', $dateTo);
        }

        $totalsQuery = clone $query;

        $productions = $query
            ->with(['buyer', 'initialOrder', 'color', 'sampleType'])
            ->orderBy('id', 'desc')
            ->get();

        $totals = [
            'production_quantity' => (float) $totalsQuery->sum('production_quantity'),
            'used_fabric_quantity' => (float) $totalsQuery->sum('used_fabric_quantity'),
        ];
        
        // If buyer is selected, get orders for filter
        $orders = [];
        if($request->buyer_id) {
             $orders = InitialOrder::where('buyer_id', $request->buyer_id)->orderBy('id', 'desc')->get(['id', 'order_code']);
        }

        $colors = collect();
        if ($request->order_id) {
            $colorIds = SampleOrderProduction::where('order_id', $request->order_id)
                ->whereNotNull('color_id')
                ->distinct()
                ->pluck('color_id');
            $colors = Color::where('is_active', 1)->whereIn('id', $colorIds)->get();
        }

        return view('sm::report.sample_production_report', compact('buyers', 'sampleTypes', 'productions', 'totals', 'orders', 'colors'));
    }
}
