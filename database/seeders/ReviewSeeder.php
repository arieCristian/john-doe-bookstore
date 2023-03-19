<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewCount = 50000;
        $chunkSize = 1000;
        DB::disableQueryLog();
        DB::transaction(function () use ($reviewCount, $chunkSize) {
            $chunks = $reviewCount / $chunkSize;
            for ($i = 0; $i < $chunks; $i++) {
                $ratings = [];
                for ($j = 0; $j < $chunkSize; $j++) {
                    $ratings[] = [
                        'book_id' => fake()->numberBetween($min = 1, $max = 10000),
                        'rating' => fake()->numberBetween($min = 1, $max = 10),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                Review::insert($ratings);
            }
        });
        DB::enableQueryLog();
    }
}
