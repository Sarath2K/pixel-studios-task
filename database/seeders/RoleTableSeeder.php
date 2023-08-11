<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Manager',
                'slug' => 'manager',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Sales Executive',
                'slug' => 'sales-executive',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Customer',
                'slug' => 'customer',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
