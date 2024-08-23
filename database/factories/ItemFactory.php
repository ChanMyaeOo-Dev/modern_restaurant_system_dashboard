<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText(1000),
            'photo' => $this->faker->imageUrl(), // Random image URL
            'price' => $this->faker->randomFloat(2, 1, 1000), // Random price between 1 and 1000
            'category_id' => Category::factory(), // Automatically associate with a category
        ];
    }
}
