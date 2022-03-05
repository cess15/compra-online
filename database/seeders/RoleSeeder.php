<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vendedor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Comprador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
