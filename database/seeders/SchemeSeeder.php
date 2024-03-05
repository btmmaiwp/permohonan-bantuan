<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schemes = [
            [
                'id' => 1,
                'name' => 'Bantuan Perubatan',
                'description' => 'Bantuan Perubatan',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'Bantuan Am',
                'description' => 'Bantuan Am',
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'Bantuan Musibah',
                'description' => 'Bantuan Musibah',
                'status' => 'inactive',
            ],
        ];

        Schema::disableForeignKeyConstraints();
        DB::table('schemes')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($schemes as $scheme) {
            DB::table('schemes')->insert($scheme);
        }
    }
}
