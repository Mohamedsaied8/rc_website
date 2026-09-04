<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Credentials come from env so no known passwords are ever committed/seeded.
        // A random password is generated if none is provided (printed once to the console).
        $adminEmail = env('ADMIN_EMAIL', 'admin@roboticscorner.com');
        $adminPassword = env('ADMIN_PASSWORD');

        if (empty($adminPassword)) {
            $adminPassword = \Illuminate\Support\Str::password(16);
            $this->command?->warn("Generated Super Admin password for {$adminEmail}: {$adminPassword}");
            $this->command?->warn('Store it now — it will not be shown again.');
        }

        Admin::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Super Admin',
                'password' => Hash::make($adminPassword),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );
    }
}
