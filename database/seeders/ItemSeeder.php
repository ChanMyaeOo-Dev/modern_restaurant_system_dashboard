<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            \App\Models\Item::factory(20)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
