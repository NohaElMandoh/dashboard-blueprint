<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'name' => 'Vendor One',
                'email' => 'vendor1@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'Vendor Two',
                'email' => 'vendor2@example.com',
                'password' => Hash::make('123'),
            ],
            // Add more vendors as needed
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }
    
    }
}
