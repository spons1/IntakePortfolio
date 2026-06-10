<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('album')->insert([
            'titel' => Str::random(10),
            'release_datum' => now(),
            'genre' => Str::random(10),
            'artist_id' => rand(1, 9),
            'user_id' => rand(1, 9),
            'cover_path' => Str::random(10),
        ]);
    }
}
