<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MedientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medients')->insert([
            'name' => 'Peter'
        ]);

        DB::table('medients')->insert([
            'name' => 'Rob'
        ]);

        DB::table('medients')->insert([
            'name' => 'Ties'
        ]);

        DB::table('medients')->insert([
            'name' => 'Jeremy'
        ]);

        DB::table('medients')->insert([
            'name' => 'Onno'
        ]);

        DB::table('medients')->insert([
            'name' => 'Leonie'
        ]);
    }
}
