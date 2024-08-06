<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
    }
}
