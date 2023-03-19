<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorCount = 100;
        DB::disableQueryLog();
        DB::transaction(function () use ($authorCount) {
                $authors = [];
                for ($i = 0; $i < $authorCount; $i++) {
                    $authors[] = [
                        'name' => fake()->name(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                Author::insert($authors);
        });
        DB::enableQueryLog();
    }
}
