<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_pekerjaan')->insert([
            [
                'nama_jenis_pekerjaan' => 'Konstruksi',
                'deskripsi' => 'Pembangunan infrastruktur dan gedung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_pekerjaan' => 'IT Development',
                'deskripsi' => 'Pembuatan aplikasi dan sistem berbasis teknologi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
