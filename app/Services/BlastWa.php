<?php 

namespace App\Services;

use App\Models\ProgressProject;
use Carbon\Carbon;

class BlastWa {
    public function __invoke(){
        $today = Carbon::today();

        $targetDates = [
            $today->copy()->addDays(0)->toDateString(),
            $today->copy()->addDays(1)->toDateString(),
            $today->copy()->addDays(3)->toDateString(),
        ];

        $progress = ProgressProject::with('karyawan')->with('project')
            ->whereIn('pengerjaan_selanjutnya', $targetDates)
            ->select('id_progress_project', 'pengerjaan_selanjutnya','keterangan_selanjutnya', 'karyawan_id', 'project_id')
            ->get();

        foreach($progress as $p){
            $selanjutnya = Carbon::parse($p->pengerjaan_selanjutnya);
            $today = Carbon::today();

            $hari = $today->diffInDays($selanjutnya, false); 
            try {
                if (!is_null($p->karyawan->no_wa)) {
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', 'http://wa-engine.adhitech.id:3001/send-message ', [
                        'headers' => [
                            'Content-type' => 'application/x-www-form-urlencoded',
                        ],
                        'form_params' => [
                            'nomor_wa' => $p->karyawan->no_wa,
                            'pesan' => "Halo {$p->karyawan->nama_karyawan} Selamat Pagi Reminder H-{$hari}\n\n".
                                "Pengingat pengerjaan proyek {$p->project->nama_project}\n" .
                                "🗓️ Tanggal Pengerjaan: {$selanjutnya->format('d M Y')}\n".
                                "📋 Keterangan: {$p->keterangan_selanjutnya}\n\n".
                                "Mohon persiapkan sesuai jadwal. Terima kasih 🙏",
                        ],
                        'timeout' => 20,
                        'connect_timeout' => 20,
                    ]);
                }
            } catch (\Throwable $th) {
                return $this->responseRedirectBackError($th->getMessage());
            }
        }
    }
}