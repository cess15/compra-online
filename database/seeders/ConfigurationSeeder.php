<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'username' => 'sistemas',
                'email' => 'kevinlata@gmail.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make('sistemas'),
                'code_verification' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('people')->insert([
            [
                'user_id' => 1,
                'per_name' => 'Kevin',
                'per_second_name' => null,
                'per_lastname' => 'Lata',
                'per_second_lastname' => 'Jacome',
                'pers_full_name' => 'Kevin Lata Jacome',
                'pers_identification' => 'sistemas',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
