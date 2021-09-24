<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();
        $typeRecords=[
            ['id'=>1,
            'name'=>'Core',
             ],
            ['id'=>2,
            'name'=>'Filter',
            ],
            ['id'=>3,
            'name'=>'Greens',
            ],
        ];
        foreach ($typeRecords as $key=>$record) {
            \App\Models\Type::create($record);         
        }
    }
}
