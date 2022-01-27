<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tracks')->insert([
            'name' => 'Multimedia',
            'isActive' => true,
        ]);

        DB::table('tracks')->insert([
            'name' => 'IT Basis',
            'isActive' => true,
        ]);

        DB::table('tracks')->insert([
            'name' => 'IT Master',
            'isActive' => true,
        ]);
    }
}
