<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

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
            "data" => $item
        ]);
    }
}
