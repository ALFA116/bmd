<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'bank'],
            ['name' => 'siswa'],
        ];

        DB::table('roles')->insert($roles);
    }
}