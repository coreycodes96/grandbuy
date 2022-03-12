<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'email' => 'admin@hotmail.co.uk',
            'admin' => 1,
            'password' => Hash::make('password'),
            'created_at' => '2022-03-09 18:57:35',
            'updated_at' => '2022-03-09 18:57:35',
        ]);
    }
}
