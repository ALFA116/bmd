<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class WalletSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->wallet) {
                $user->wallet()->create([
                    'credit' => 0,
                    'debit' => 0,
                    'status' => 'active',
                ]);
            }
        }
    }
}
