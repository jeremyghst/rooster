<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal A',
            'abbreviation' => 'MA',
            'track_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal B',
            'abbreviation' => 'MB',
            'track_id' => 1,
        ]);

        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal C',
            'abbreviation' => 'ITBC',
            'track_id' => 2,
        ]);

        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal D',
            'abbreviation' => 'ITBD',
            'track_id' => 2,
        ]);

        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal E',
            'abbreviation' => 'ITME',
            'track_id' => 3,
        ]);

        DB::table('rooms')->insert([
            'number' => 'abc',
            'name' => 'Lokaal F',
            'abbreviation' => 'ITMF',
            'track_id' => 3,
        ]);
    }
}
