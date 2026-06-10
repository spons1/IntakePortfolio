<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use League\CommonMark\Node\Block\Paragraph;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artists')->insert([
            'name' => Str::random(10),
            'starting_year' => rand(1950, 2024),
            'description' => Str::random(length: 75),
            'image_path' => Str::random(10),
        ]);
    }
}
