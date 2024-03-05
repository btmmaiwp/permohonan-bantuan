<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = [
            [
                'id' => 1,
                'user_id' => 3, // Pemohon
                'scheme_id' => 1, // Bantuan Perubatan
                'amount' => 1000.55,
                'status' => 'baru',
                'created_by' => 3 // Pemohon
            ],
            [
                'id' => 2,
                'user_id' => 3, // Pemohon
                'scheme_id' => 2, // Bantuan Am
                'amount' => 10000.00,
                'status' => 'baru',
                'created_by' => 2 // Staff
            ],
            [
                'id' => 3,
                'user_id' => 3, // Pemohon
                'scheme_id' => 3, // Bantuan Musibah
                'amount' => 500.00,
                'status' => 'baru',
                'created_by' => 3 // Pemohon
            ]
        ];

        Schema::disableForeignKeyConstraints();
        DB::table('applications')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($applications as $application) {
            DB::table('applications')->insert($application);
        }
    }
}
