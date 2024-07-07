<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();

        $categories = ["Web", "Mobile", "News", "General", "Technology"];
        foreach($categories as $category) {
            \App\Models\Category::create([
                "name" => $category
            ]);
        }

        \App\Models\User::factory()->create([
            "name" => "Alice",
            "email" => "alice@gmail.com"
        ]);
        \App\Models\User::factory()->create([
            "name" => "Bob",
            "email" => "bob@gmail.com"
        ]);
    }
}
