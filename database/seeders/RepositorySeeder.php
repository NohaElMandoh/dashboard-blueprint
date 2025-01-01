<?php

namespace Database\Seeders;

use App\Models\Repository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $repositories = [
            [
                'name' => json_encode(['en' => 'Repository 1', 'ar' => 'مستودع 1']),
                'description' => json_encode(['en' => 'Description for Repository 1', 'ar' => 'وصف المستودع 1']),
                'type_id' => 1,
                'verified' => true,
                'status' => 'active',
                'main_photo' => 'path/to/photo1.jpg',
                'user_id' => 1,
                'area' => 'Area 1',
            ],
            [
                'name' => json_encode(['en' => 'Repository 2', 'ar' => 'مستودع 2']),
                'description' => json_encode(['en' => 'Description for Repository 2', 'ar' => 'وصف المستودع 2']),
                'type_id' => 2,
                'verified' => false,
                'status' => 'inactive',
                'main_photo' => 'path/to/photo2.jpg',
                'user_id' => 2,
                'area' => 'Area 2',
            ],
            // Add more repositories as needed
        ];

        foreach ($repositories as $repository) {
            Repository::create($repository);
        }
    }
}
