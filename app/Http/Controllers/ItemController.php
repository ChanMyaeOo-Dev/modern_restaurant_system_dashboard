<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $items = ItemResource::collection($items);
        return view('item.index', ["items" => $items->toArray(request())]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where('name', 'like', "%{$query}%")->get();
        return response()->json(ItemResource::collection($items));
    }

    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|max:255',
            'category' => 'required|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
        $request->validate($rules);
        $item = new Item();
        if (isset($request->photo)) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $item->photo = $imageName;
        }
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category;
        $item->save();
        return back()->with('success_message', 'New Item has been successfully saved.');
    }


    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view(
            'item.edit',
            [
                'item' => (new ItemResource($item))->toArray(request()),
                'categories' => $categories
            ]
        );
    }

    public function update(Request $request, Item $item)
    {
        $old_photo = $item->photo;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category;
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            // Delete Old Photo
            $path = public_path('images/' . $old_photo);
            if (file_exists($path)) {
                unlink($path);
            }
            $item->photo = $imageName;
        } else {
            $item->photo = $old_photo;
        }
        $item->update();
        return back()->with('success_message', 'Item has been successfully updated.');
    }

    public function destroy(Item $item)
    {
        if ($item->photo) {
            $path = public_path('images/' . $item->photo);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $item->delete();
        return back()->with('success_message', 'Item has been successfully deleted.');
    }
}
