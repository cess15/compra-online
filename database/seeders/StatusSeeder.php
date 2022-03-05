<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'st_name' => 'Disponible',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'st_name' => 'Pendiente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'st_name' => 'Verificado',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}