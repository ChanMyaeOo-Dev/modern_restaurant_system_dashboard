<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{

    public function definition()
    {
        $save_path = public_path('images/' . "qr_test" . '.svg');
        $path = 'images/' . "qr_test" . '.svg';
        QrCode::size(300)
            ->generate("Testing Qr", $save_path);
        return [
            'name' => $this->faker->name . "_" . random_int(1, 20),
            'qr_code' => $path,
            'status' => $this->faker->randomElement(['available', 'busy']),
        ];
    }
}
