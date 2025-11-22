<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin user
        if (!User::where('email', 'admin@masakku.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@masakku.com',
                'password' => Hash::make('admin123'),
                'status' => 'Active',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
        }

        // 20 random user
        User::factory()->count(20)->create([
            'is_admin' => false,
            'status' => 'Active',
        ]);

        // 5 inactive/banned user
        User::factory()->count(5)->create([
            'is_admin' => false,
            'status' => 'Inactive',
        ]);
    }
}


