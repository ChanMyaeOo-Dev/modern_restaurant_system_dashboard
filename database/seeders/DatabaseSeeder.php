<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Seed categories first
        $this->call(CategorySeeder::class);
        // Seed items after categories
        $this->call(ItemSeeder::class);
        //Seed Tables
        $this->call(TableSeeder::class);
        Cart::factory()->create([
            'user_id' => '1',
            'item_id' => '1',
            'quantity' => 2,
        ]);
        Cart::factory()->create([
            'user_id' => '1',
            'item_id' => '2',
            'quantity' => 2,
        ]);
    }
}
