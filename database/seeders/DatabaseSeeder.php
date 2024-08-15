<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
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
