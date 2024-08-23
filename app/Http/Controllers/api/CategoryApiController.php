<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryApiResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function categories()
    {
        $categories = Category::all();
        $categories = CategoryApiResource::collection($categories);
        return response()->json([
            "success" => true,
            "data" => $categories
        ]);
    }
    public function itemByCategory($id)
    {
        $category = Category::find($id);
        $items = Category::find($id)->items;
        $items = ItemResource::collection($items);
        return response()->json([
            "success" => true,
            "category" => $category->name,
            "items" => $items
        ]);
    }
}
