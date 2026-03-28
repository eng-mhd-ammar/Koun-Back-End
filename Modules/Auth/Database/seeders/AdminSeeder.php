<?php

namespace Modules\Auth\Database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Auth\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'avatar' => null,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'password' => 'admin123',
            'email' => 'admin@example.com',
            'phone' => '0999999999',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'birthday' => now(),
            'gender' => 1,
        ]);

        $user->assignRole(['admin', 'user']);
    }
}
