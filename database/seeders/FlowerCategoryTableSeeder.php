<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlowerCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flower_categories')->delete();
        $categoryRecords=[
            ['id'=>1,
            'season_id'=>'1',
            'type_id'=>'1',
            'name'=>'ALSTROMERIA',
             ],
             ['id'=>2,
             'season_id'=>'2',
             'type_id'=>'2',
             'name'=>'ARALIA',
              ],
              ['id'=>3,
              'season_id'=>'3',
              'type_id'=>'3',
              'name'=>'BEARGRASS',
               ],
        ];
        foreach ($categoryRecords as $key=>$record) {
            \App\Models\FlowerCategory::create($record);         
        }
    }
}
