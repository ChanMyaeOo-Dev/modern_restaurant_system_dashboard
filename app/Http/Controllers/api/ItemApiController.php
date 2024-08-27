<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HotItemResource;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Item;

class ItemApiController extends Controller
{
    public function items()
    {
        $items = Category::with('items')->get();
        $items = CategoryResource::collection($items);
        return response()->json([
            "success" => true,
            "data" => $items
        ]);
    }

    public function show($id)
    {
        $item = Item::where('id', $id)->first();
        return response()->json([
            "success" => true,
            "data" => new ItemResource($item)
        ]);
    }

    public function hot_items()
    {
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
        return response()->json([
            "success" => true,
            "data" => HotItemResource::collection($hotItems)
        ]);
    }
}
