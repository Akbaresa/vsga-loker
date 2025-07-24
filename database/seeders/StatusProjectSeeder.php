<?php

namespace Database\Seeders;

use App\Models\StatusProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusProject::insert(
            [  
                [
                    'nama_status_project' => 'Done',
                    'warna' => '#05ff5d'
                ],
                [
                    'nama_status_project' => 'Progress',
                    'warna' => '#ff6600'
                ],
            ]
    );
    }
}
