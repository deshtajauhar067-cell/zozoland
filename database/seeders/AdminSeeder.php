<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@zozoland.com'],
            [
                'name' => 'Admin ZozoLand',
                'email' => 'admin@zozoland.com',
                'password' => bcrypt('password123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create test user (non-admin)
        User::updateOrCreate(
            ['email' => 'user@zozoland.com'],
            [
                'name' => 'Test User',
                'email' => 'user@zozoland.com',
                'password' => bcrypt('password123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin and test users seeded successfully!');
    }
}
