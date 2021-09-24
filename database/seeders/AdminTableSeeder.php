<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        //password 123456
        $adminRecords=[
            ['id'=>1,
            'name'=>'admin',
            'email'=>'admin@yopmail.com',
            'password'=>'$2y$10$gSZzaK3nanYoxK.3ZFxcpuDZzg9bIcfpEfpyKskeBvfyO5wCE026W',
            'type'=>'Admin',],
            ['id'=>2,
            'name'=>'admin2',
            'email'=>'admin2@yopmail.com',
            'password'=>'$2y$10$gSZzaK3nanYoxK.3ZFxcpuDZzg9bIcfpEfpyKskeBvfyO5wCE026W',
            'type'=>"Admin",],
        ];
        //DB::table('admins')->insert($adminRecords);
        foreach ($adminRecords as $key=>$record) {
            \App\Models\Admin::create($record);
            
        }
    }
}
