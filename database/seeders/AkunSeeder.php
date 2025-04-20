<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('roles')->pluck('id', 'name')->toArray();

        $akun = [
            [
                'name' => 'Alfa',
                'roles_id' => $roles['admin'],
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin123'),
            ],
            [
                'name' => 'Bank',
                'roles_id' => $roles['bank'],
                'email' => 'bank@gmail.com',
                'password' => bcrypt('Bank123'),
            ],
            [
                'name' => 'Siswa',
                'roles_id' => $roles['siswa'],
                'email' => 'siswa@gmail.com',
                'password' => bcrypt('Siswa123'),
            ],
            [
                'name' => 'Abeng',
                'roles_id' => $roles['siswa'],
                'email' => 'filbert@gmail.com',
                'password' => bcrypt('Abeng123')
            ],
            [
                'name' => 'Lekus',
                'roles_id' => $roles['siswa'],
                'email' => 'leksa@gmail.com',
                'password' => bcrypt('Lekus123')
            ]
        ];

        foreach ($akun as $val) {
            User::create($val);
        }
    }
}
