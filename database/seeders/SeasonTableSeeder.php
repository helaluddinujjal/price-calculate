<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->delete();
        $seasonRecords=[
            ['id'=>1,
            'name'=>'All Session',
             ],
            ['id'=>2,
            'name'=>'Summer',
            ],
            ['id'=>3,
            'name'=>'Winter',
            ],
        ];
        foreach ($seasonRecords as $key=>$record) {
            \App\Models\Season::create($record);         
        }
    }
}
