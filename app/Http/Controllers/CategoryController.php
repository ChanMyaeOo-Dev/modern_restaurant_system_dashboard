<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::where('name', 'like', "%{$query}%")->get();
        return response()->json(CategoryResource::collection($categories));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $request->validate($rules);
        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $imageName);
        $category = new Category();
        $category->name = $request->name;
        $category->photo = $imageName;
        $category->save();
        return back()->with('success_message', 'New Category has been successfully saved.');
    }


    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $old_photo = $category->photo;
        $category->name = $request->name;
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $category->photo = $imageName;
        } else {
            $category->photo = $old_photo;
        }
        $category->update();
        return back()->with('success_message', 'Category has been successfully updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        if ($category->photo) {
            $path = public_path('images/' . $category->photo);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return back()->with('success_message', 'Category has been successfully deleted.');
    }
}
