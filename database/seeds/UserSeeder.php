<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Enzo David Duré',
            'email' => 'enzod98@hotmail.com',
            'password' => Hash::make('123456789'),
            'paginaweb' => 'https://enzodure.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'John Connor',
            'email' => 'jconnor@hotmail.com',
            'password' => Hash::make('123456789'),
            'paginaweb' => 'https://johnconnor.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
