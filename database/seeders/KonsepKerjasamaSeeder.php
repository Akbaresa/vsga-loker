<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonsepKerjasamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('konsep_kerjasama')->insert([
            [
                'nama_konsep_kerjasama' => 'Bagi Hasil',
                'deskripsi' => 'Kerjasama dengan sistem bagi hasil sesuai kesepakatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_konsep_kerjasama' => 'Fixed Price',
                'deskripsi' => 'Kerjasama dengan harga tetap tanpa perubahan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
