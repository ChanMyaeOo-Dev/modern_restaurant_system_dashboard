<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name . "_" . random_int(1, 20),
            'qr_code' => $this->faker->name,
            'status' => $this->faker->randomElement(['available', 'busy']),
        ];
    }
}
