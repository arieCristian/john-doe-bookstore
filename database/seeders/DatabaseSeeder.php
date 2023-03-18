<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Category::factory(300)->create();
        \App\Models\Author::factory(100)->create();
        \App\Models\Book::factory(10000)->create();
        \App\Models\Review::factory(50000)->create();

    }
}
