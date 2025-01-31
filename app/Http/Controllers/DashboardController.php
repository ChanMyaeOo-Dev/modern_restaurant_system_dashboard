<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Feedback;
use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_sale = Order::sum('total_price');
        $orders = Order::where('is_completed', '0')->latest()->take(8)->get();
        $last7DaysIncome = Order::where('is_completed', '1') // Assuming '1' means the order is completed
            ->whereDate('created_at', '>=', Carbon::now()->subDays(6)) // Get orders from the last 7 days including today
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as income')) // Replace 'total_price' with your income field
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date'); // Key by the date for easier lookup

        $last7DaysIncomeArray = [];
        $last7Days = [];

        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $income = $last7DaysIncome->has($date) ? $last7DaysIncome[$date]->income : 0;
            $date = Carbon::now()->subDays(6 - $i)->format('D');
            $last7Days[] = $date;
            $last7DaysIncomeArray[] = $income;
        }
        $totalSale = array_sum($last7DaysIncomeArray);
        $last7DaysIncomeArray = json_encode($last7DaysIncomeArray);

        $hotItems = DB::table('order_items')
            ->join('items', 'order_items.item_id', '=', 'items.id')
            ->select(
                'items.id',
                'items.name',
                'items.photo',
                'items.price',
                DB::raw('SUM(order_items.quantity) as total_ordered')
            )
            ->groupBy('items.id', 'items.name', 'items.price')
            ->orderBy('total_ordered', 'desc')
            ->take(5)->get();

        $feedbacks = Feedback::latest()->limit(50)->get();
        $ratings = $feedbacks->pluck('rating')->toArray(); // Assuming 'rating' is the column name
        $ratingDistribution = array_count_values($ratings); // Count occurrences of each rating
        $ratingDistribution = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0], $ratingDistribution);

        $latest_items = Item::latest()->take(5)->get();
        $latest_items = ItemResource::collection($latest_items);

        return view('dashboard.index', compact('orders', 'totalSale', 'last7DaysIncomeArray', 'last7Days', 'hotItems', 'total_sale', 'latest_items', 'ratingDistribution'));
    }
}
