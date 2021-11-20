<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            // [
            // 'name' => 'Đặng Thẳng',
            // 'email' => 'tinhlagi45678@gmail.com',
            // 'password' => Hash::make('dangthang77pro'),
            // ],
            [
                'name' => 'Nguyễn Ánh Nguyệt',
                'email' => 'dt77pro@gmail.com',
                'password' => Hash::make('dangthang77pro'),
            ]

        );
    }   
}
