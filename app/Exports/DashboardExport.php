<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class DashboardExport implements FromArray, WithHeadings, WithTitle
{
    protected $statusHeaders = [];

    public function array(): array
    {
        $projectChart = Project::with([
            'anggota.karyawan:id_karyawan,nama_karyawan',
            'progress_project.status_project:id_status_project,nama_status_project',
            'client:id_client,nama_client',
        ])->get();

        $progressPerKaryawan = [];
        $allStatuses = [];
        $projectTable = [];

        foreach ($projectChart as $project) {
            $anggotaKaryawan = [];

            foreach ($project->anggota as $anggota) {
                $nama = $anggota->karyawan->nama_karyawan ?? 'Tidak dikenal';
                $anggotaKaryawan[$nama] = true;
            }

            foreach ($project->progress_project as $progress) {
                $karyawanId = $progress->karyawan_id;
                $nama = $project->anggota->firstWhere('karyawan_id', $karyawanId)?->karyawan->nama_karyawan ?? 'Tidak dikenal';

                $status = $progress->status_project->nama_status_project ?? 'Unknown';
                $allStatuses[$status] = true;

                if (!isset($progressPerKaryawan[$nama])) {
                    $progressPerKaryawan[$nama] = [];
                }

                $progressPerKaryawan[$nama][$status] = ($progressPerKaryawan[$nama][$status] ?? 0) + 1;
            }

            // Key unik: nama_project - client
            $projectKey = "{$project->nama_project} - " . ($project->client->nama_client ?? '-');

            // Hindari duplikat
            if (!isset($projectTable[$projectKey])) {
                $projectTable[$projectKey] = [];
            }

            foreach (array_keys($anggotaKaryawan) as $namaAnggota) {
                if (!in_array($namaAnggota, $projectTable[$projectKey])) {
                    $projectTable[$projectKey][] = $namaAnggota;
                }
            }
        }

        // === Rekap Progress ===
        $statusHeaders = array_keys($allStatuses);
        $this->statusHeaders = $statusHeaders;

        $rows = [];
        foreach ($progressPerKaryawan as $nama => $statusData) {
            $row = [$nama];
            foreach ($statusHeaders as $status) {
                $row[] = $statusData[$status] ?? 0;
            }
            $rows[] = $row;
        }

        // === Baris kosong sebagai pemisah ===
        $rows[] = [];

        // === Header bagian 2: "Project - client", lalu "Anggota 1", "Anggota 2", ... ===
        $maxAnggota = max(array_map('count', $projectTable));
        $header2 = ['Project - client'];
        for ($i = 1; $i <= $maxAnggota; $i++) {
            $header2[] = "Anggota {$i}";
        }

        $rows[] = $header2;

        // === Isi bagian 2 ===
        foreach ($projectTable as $projectName => $anggotaList) {
            $row = [$projectName];
            foreach ($anggotaList as $namaAnggota) {
                $row[] = $namaAnggota;
            }
            // isi kosong jika anggota kurang dari max
            while (count($row) < count($header2)) {
                $row[] = '';
            }
            $rows[] = $row;
        }

        return $rows;
    }

    public function headings(): array
    {
        return array_merge(['Nama Karyawan'], $this->statusHeaders);
    }

    public function title(): string
    {
        return 'Progress & Project';
    }
}
