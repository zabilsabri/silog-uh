<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'adminlab',
            'password' => 'password123',
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'H071211016',
            'password' => 'H071211016',
            'role' => 'user'
        ]);
    }
}
