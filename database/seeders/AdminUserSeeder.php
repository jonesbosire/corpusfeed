<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@corpusfeed.co.ke'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@corpusfeed.co.ke',
                'password' => bcrypt('Admin@1234'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
