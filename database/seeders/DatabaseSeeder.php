<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Feedback;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Feedback::factory()->count(10)->create();
        // \App\Models\User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        // Seed categories first
        // $this->call(CategorySeeder::class);
        // Seed items after categories
        // $this->call(ItemSeeder::class);
        //Seed Tables
        // Table::factory()->create([
        //     'name' => 'admin_table',
        //     'qr_code' => 'admin',
        // ]);

        // $table_id = round(microtime(true) * 1000);
        // // Generate QrCode
        // $filename = "table_qr_" . "Table_A" . "_" . time() . '.svg';
        // $path = public_path('qr_codes/' . $filename);
        // QrCode::size(300)
        //     ->generate("http://192.168.10.223:3000/table/" . $table_id, $path);
        // Table::factory()->create([
        //     "id" => $table_id,
        //     "name" => "Table A",
        //     "qr_code" => $filename,
        // ]);

        // Cart::factory()->create([
        //     'table_id' => '5',
        //     'item_id' => '1',
        //     'quantity' => 2,
        // ]);
        // Cart::factory()->create([
        //     'table_id' => '5',
        //     'item_id' => '2',
        //     'quantity' => 2,
        // ]);
    }
}


// php artisan serve --host=192.168.100.99 --port=8000 //Machine Wifi


// Merchat public key
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2w9xvFJNFZRWshQgfReIHCDLlE5xos+MsOX0Zt4R9HspFbeqPQ19rbX6q7hHWHtARrEbu0qeJ79vrqHYAFDT4hKG3sBjtMnsgHWWPeJ6QmiCE/KJaD/vbjQKmYHDNPkUtPdVBTRxIXbJFbs1oipvbEQ2RLYWRqGHL0oGzO1EvcQIDAQAB

// Full Api Key
// ptc99er.Y0GWC66tobKN1B2FNt8P6_wMHd0

// Callback Key
// 404ae61f7bddfccad62a9a5789da2051
