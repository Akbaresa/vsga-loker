<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::insert(
        [
            [
                'nama_karyawan' => 'Karyawan 1',
                'email' => 'karyawan1@mail.com',
                'no_wa' => '081234567890',
                'password' => Hash::make('karyawan1@mail.com'),
                'is_admin' => true,
                'jabatan_id' => 1,
            ],
            [
                'nama_karyawan' => 'Karyawan 2',
                'email' => 'karyawan2@mail.com',
                'no_wa' => '089876543212',
                'password' => Hash::make('karyawan2@mail.com'),
                'is_admin' => false,
                'jabatan_id' => 2,
            ],
            [
                'nama_karyawan' => 'Karyawan 3',
                'email' => 'karyawan3@mail.com',
                'no_wa' => '089876543213',
                'password' => Hash::make('karyawan3@mail.com'),
                'is_admin' => false,
                'jabatan_id' => 2,
            ],
            [
                'nama_karyawan' => 'Karyawan 4',
                'email' => 'karyawan4@mail.com',
                'no_wa' => '089876543214',
                'password' => Hash::make('karyawan4@mail.com'),
                'is_admin' => false,
                'jabatan_id' => 2,
            ],
            [
                'nama_karyawan' => 'Karyawan 5',
                'email' => 'karyawan5@mail.com',
                'no_wa' => '089876543210',
                'password' => Hash::make('karyawan5@mail.com'),
                'is_admin' => false,
                'jabatan_id' => 2,
            ]
        ]
        );
    }
}
