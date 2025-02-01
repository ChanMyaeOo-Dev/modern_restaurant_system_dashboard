<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('is_completed', '1');
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'last_week':
                    $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
                    break;
                case 'last_month':
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
                    break;
                case 'last_year':
                    $query->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()]);
                    break;
                case 'custom':
                    if ($request->start_date && $request->end_date) {
                        $startDate = Carbon::parse($request->start_date)->startOfDay();
                        $endDate = Carbon::parse($request->end_date)->endOfDay();
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    }
                    break;
            }
        }
        // Get total orders and total income grouped by date
        $dailyReport = $query
            ->selectRaw('DATE(created_at) as order_date, COUNT(*) as total_orders, SUM(total_price) as total_income')
            ->groupBy('order_date')
            ->orderByDesc('order_date')
            ->get();

        return view('reports.index', compact('dailyReport'));
    }

    public function create()
    {
        //
    }

    public function store(StoreReportRequest $request)
    {
        //
    }

    public function show(Report $report)
    {
        //
    }

    public function edit(Report $report)
    {
        //
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    public function destroy(Report $report)
    {
        //
    }
}
