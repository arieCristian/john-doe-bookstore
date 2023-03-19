<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryCount = 300;
        DB::disableQueryLog();
        DB::transaction(function () use ($categoryCount) {
                $categories = [];
                for ($i = 0; $i < $categoryCount; $i++) {
                    $categories[] = [
                        'name' => fake()->sentence($nbWords = 3, $variableNbWords = true),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                Category::insert($categories);
        });
        DB::enableQueryLog();
    }
}
