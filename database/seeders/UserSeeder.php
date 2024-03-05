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
                'password' => Hash::make('password'),
            ],
            [
                'id' => 2,
                'name' => 'Staff',
                'email' => 'staff@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 3,
                'name' => 'Pemohon',
                'email' => 'pemohon@example.com',
                'password' => Hash::make('password'),
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
