<?php

namespace Database\Seeders;

use App\Models\KategoriItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriItem::insert([
            [
                'nama_kategori_item' => 'CLIENT INFORMATION'
            ],
            [
                'nama_kategori_item' => 'KETENTUAN PENAGIHAN'
            ]
        ]);
    }
}
