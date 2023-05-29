<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        DB::table('users')->insert([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password999'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => null
        ]);
    }
}
