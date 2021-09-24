<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        //password 123456
        $usersRecords=[
            ['id'=>1,
            'name'=>'user',
            'email'=>'user@yopmail.com',
            'password'=>'$2y$10$gSZzaK3nanYoxK.3ZFxcpuDZzg9bIcfpEfpyKskeBvfyO5wCE026W',
            'status'=>1
        ],
            ['id'=>2,
            'name'=>'user2',
            'email'=>'user2@yopmail.com',
            'password'=>'$2y$10$gSZzaK3nanYoxK.3ZFxcpuDZzg9bIcfpEfpyKskeBvfyO5wCE026W',
            'status'=>1
            ]
        ];
        foreach ($usersRecords as $key=>$record) {
            \App\Models\User::create($record);
            
        }
    }
}
