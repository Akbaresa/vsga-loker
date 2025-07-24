<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_person')->insert([
            [
                'nama_contact_person' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'no_telp_wa' => '081212345678',
                'client_id' => 1, // Sesuai dengan id_client dari tabel client
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_contact_person' => 'Siti Aisyah',
                'email' => 'siti.aisyah@example.com',
                'no_telp_wa' => '081298765432',
                'client_id' => 2, // Sesuai dengan id_client dari tabel client
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
