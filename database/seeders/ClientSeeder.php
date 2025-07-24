<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('client')->insert([
            [
                'nama_client' => 'PT Maju Jaya',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'email' => 'majujaya@example.com',
                'no_telp' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_client' => 'CV Sejahtera',
                'alamat' => 'Jl. Diponegoro No. 25, Bandung',
                'email' => 'sejahtera@example.com',
                'no_telp' => '08234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
