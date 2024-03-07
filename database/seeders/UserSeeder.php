<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Staff',
                'email' => 'staff@example.com',
                'role' => 'staff',
                'password' => Hash::make('password'),
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Pemohon',
                'email' => 'pemohon@example.com',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now()
            ],
        ];

        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
