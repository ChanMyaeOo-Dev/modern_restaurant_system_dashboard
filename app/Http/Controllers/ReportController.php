<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Order;
use App\Models\Report;

class ReportController extends Controller
{

    public function index()
    {
        $orders = Order::where('is_completed', '1')->latest()->get();
        return view('reports.index', compact('orders'));
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
