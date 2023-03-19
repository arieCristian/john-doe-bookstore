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
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Author::factory(20)->create();
        // \App\Models\Book::factory(100)->create();
        // \App\Models\Review::factory(500)->create();

        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            ReviewSeeder::class
        ]);

    }
}
