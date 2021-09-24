<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //google.com/
        DB::table('companies')->delete();
        $companyRecords=[
            ['id'=>1,
            'name'=>'Vianen',
            'url'=>'www.google.com/',
             ],
            ['id'=>2,
            'name'=>'Van Vliet',
            'url'=>'www.youtube.com/',
            ],
            ['id'=>3,
            'name'=>'Van der Plas',
            'url'=>'www.facebook.com/',
            ],
        ];
        foreach ($companyRecords as $key=>$record) {
            \App\Models\Company::create($record);         
        }
    }
}
