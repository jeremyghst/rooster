<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'days' => '{
                "maandag":{
                   "ochtend":1,
                   "middag":2
                },
                "dinsdag":{
                   "ochtend":1,
                   "middag":2
                },
                "woensdag":{
                   "ochtend":1,
                   "middag":2
                },
                "donderdag":{
                   "ochtend":1,
                   "middag":2
                },
                "vrijdag":{
                   "ochtend":1,
                   "middag":2
                }
             }'
        ]);
    }
}
