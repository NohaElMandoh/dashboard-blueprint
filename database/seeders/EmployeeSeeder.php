<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'position' => 'Manager',
            'photo' => 'path/to/photo.jpg',
            'password' => Hash::make('password123'),
        ]);

        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'position' => 'Developer',
            'photo' => 'path/to/photo.jpg',
            'password' => Hash::make('password123'),
        ]);

        // Add more employees as needed
    }
}