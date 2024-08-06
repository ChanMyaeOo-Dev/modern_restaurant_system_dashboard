<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function categories()
    {
        $categories = Category::with('items')->get();
        $categories = CategoryResource::collection($categories);
        return response()->json([
            "success" => true,
            "data" => $categories
        ]);
    }
}
