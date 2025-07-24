<?php

namespace Database\Seeders;

use App\Models\ItemTnc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTncSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemTnc::insert([
            [
                'nama_item_tnc' => 'PENAGIHAN',
                'urutan' => 1,
                'is_active' => 1,
                'kategori_item_id' => 2,
            ],
            [
                'nama_item_tnc' => 'MEKANISME PEMBAYARAN INVOICE',
                'urutan' => 2,
                'is_active' => 1,
                'kategori_item_id' => 2,
            ],
            [
                'nama_item_tnc' => 'COST PROJECT',
                'urutan' => 3,
                'is_active' => 1,
                'kategori_item_id' => 1,
            ],
            [
                'nama_item_tnc' => 'DESKRIPSI PEKERJAAN',
                'urutan' => 4,
                'is_active' => 1,
                'kategori_item_id' => 1,
            ],
        ]);
    }
}
