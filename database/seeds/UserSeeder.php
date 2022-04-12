<?php

use App\User;
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
        $user = User::create([
            'name' => 'Enzo David Duré',
            'email' => 'enzod98@hotmail.com',
            'password' => Hash::make('123456789'),
            'paginaweb' => 'https://enzodure.com'
        ]);

        $user2 = User::create([
            'name' => 'David',
            'email' => 'enzod98@gmail.com',
            'password' => Hash::make('123456789'),
            'paginaweb' => 'https://enzodure.com'
        ]);
    }
}
