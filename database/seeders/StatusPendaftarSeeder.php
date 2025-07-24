<?php

namespace Database\Seeders;

use App\Models\StatusPendaftar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPendaftar::create([
            'nama_status_pendaftar' => 'daftar'
        ]);
        StatusPendaftar::create([
            'nama_status_pendaftar' => 'pending'
        ]);
        StatusPendaftar::create([
            'nama_status_pendaftar' => 'masuk kriteria'
        ]);
        StatusPendaftar::create([
            'nama_status_pendaftar' => 'Interview'
        ]);
    }
}
