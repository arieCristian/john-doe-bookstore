<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookCount = 10000;
        $chunkSize = 1000;
        DB::disableQueryLog();
        DB::transaction(function () use ($bookCount, $chunkSize) {
            $chunks = $bookCount / $chunkSize;
            for ($i = 0; $i < $chunks; $i++) {
                $books = [];
                for ($j = 0; $j < $chunkSize; $j++) {
                    $books[] = [
                        'category_id' => fake()->numberBetween($min = 1, $max = 300),
                        'author_id' => fake()->numberBetween($min = 1, $max = 100),
                        'name' => fake()->sentence($nbWords = 6, $variableNbWords = true),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                Book::insert($books);
            }
        });
        DB::enableQueryLog();
    }
}
