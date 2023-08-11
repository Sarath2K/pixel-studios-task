<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@pixel-studios.com',
            'phone' => '1234567890',
            'gender' => 'Male',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $user->assignRole('Admin');
    }
}
