<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLowongan;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $pendaftaran = PendaftaranLowongan::join('karyawan', 'karyawan.id_karyawan', 'pendaftaran_lowongan.karyawan_id')
            ->join('status_pendaftar', 'status_pendaftar.id_status_pendaftar', 'pendaftaran_lowongan.status_pendaftar_id')
            ->join('lowongan', 'lowongan.id_lowongan', 'pendaftaran_lowongan.lowongan_id')
            ->get();

            return datatables()->of($pendaftaran)
                ->addIndexColumn()
                ->make(true);
        }

        return view('karyawan.pendaftaran.index');
    }
}
