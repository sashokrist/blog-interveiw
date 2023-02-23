<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Programming',
                'slug' => Str::slug('PHP'),
                'created_at' => now(),
            ],
            [
                'name' => 'Sport',
                'slug' => Str::slug('ski'),
                'created_at' => now(),
            ],
            [
                'name' => 'Cars',
                'slug' => Str::slug('BMW'),
                'created_at' => now(),
            ],
            [
                'name' => 'Pets',
                'slug' => Str::slug('cocker spaniel'),
                'created_at' => now(),
            ],
        ];
        Category::insert($data);
    }
}
