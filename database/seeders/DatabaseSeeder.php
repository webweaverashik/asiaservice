<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\FileUpload;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'AsiaStar Admin',
            'email' => 'admin@asiastar',
            'password' => bcrypt('12345678'),
        ]);


        FileUpload::create([
            'reference_key' => "TEST",
            'csv_name' => '4-dollar-batch.csv',
            'file_url' => 'http://ipv4.download.thinkbroadband.com/5MB.zip',
            'pin_count' => 100,
            'balance' => '10.00',
        ]);

        FileUpload::create([
            'reference_key' => "sabuj-mia",
            'csv_name' => '200-pin.csv',
            'file_url' => 'http://ipv4.download.thinkbroadband.com/5MB.zip',
            'pin_count' => 200,
            'balance' => '5.00',
        ]);
    }
}
