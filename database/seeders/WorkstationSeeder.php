<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $days = '{
            "maandag":{
               "ochtend":{
                   "id": 2,
                   "startsLater": 1,
                   "endsEarlier": 0,
                   "isReserved": 0,
                   "isActive": 1
               },
               "middag":{
                   "id": 3,
                   "startsLater": 0,
                   "endsEarlier": 0,
                   "isReserved": 0,
                   "isActive": 1
               }
            },
            "dinsdag":{
                "ochtend":{
                    "id": 2,
                    "startsLater": 0,
                    "endsEarlier": 1,
                    "isReserved": 0,
                    "isActive": 1
                },
                "middag":{
                    "id": 0,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 1
                }
            },
            "woensdag":{
                "ochtend":{
                    "id": 1,
                    "startsLater": 1,
                    "endsEarlier": 1,
                    "isReserved": 0,
                    "isActive": 1
                },
                "middag":{
                    "id": 2,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 1
                }
            },
            "donderdag":{
                "ochtend":{
                    "id": 1,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 1
                },
                "middag":{
                    "id": 3,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 1
                }
            },
            "vrijdag":{
                "ochtend":{
                    "id": 1,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 1
                },
                "middag":{
                    "id": 0,
                    "startsLater": 0,
                    "endsEarlier": 0,
                    "isReserved": 0,
                    "isActive": 0
                }
            }
         }';

        DB::table('workstations')->insert([
            'room_id' => 1,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 1,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 2,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 2,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 3,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 3,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 4,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 4,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 5,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 5,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 6,
            'number' => '01',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);

        DB::table('workstations')->insert([
            'room_id' => 6,
            'number' => '02',
            'description' => 'NUC',
            'system' => 'Apple',
            'days' => $days,
        ]);
    }
}
