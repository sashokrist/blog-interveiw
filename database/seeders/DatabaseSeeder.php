<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // App\Models\Category::factory(10)->create();
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
        Post::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
