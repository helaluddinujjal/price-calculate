<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(AdminTableSeeder::class);
        //$this->call(SeasonTableSeeder::class);
        //$this->call(TypeTableSeeder::class);
        //$this->call(FlowerCategoryTableSeeder::class);
        //$this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
