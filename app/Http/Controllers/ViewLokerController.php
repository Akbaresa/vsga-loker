<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Lowongan;
use App\Models\PendaftaranLowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ViewLokerController extends Controller
{
    public function index(Request $request){
        $lowongan = Lowongan::all();

        return view('karyawan.viewlowongan.index', [
            'lowongan' => $lowongan
        ]);
    }

    public function daftar($id){
        $decryptId = decrypt($id);
        $lowongan = Lowongan::where('id_lowongan', $decryptId)->first();

        return view('karyawan.viewlowongan.daftar', [
            'lowongan' => $lowongan
        ]);
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'file_cv' => 'required',
            'surat_lamaran' => 'required',
            'id_lowongan' => 'required',
        ]);

        try {
            if($request->hasFile('file_cv')){
                $path = $request->file('file_cv')->store('/', 'file-cv');

            }
            PendaftaranLowongan::insert([
                'file_cv' => $path,
                'surat_lamaran' => $request->surat_lamaran,
                'lowongan_id' => $request->id_lowongan,
                'karyawan_id' => Karyawan::getKaryawan()->id_karyawan,
                'status_pendaftar_id' => 1
            ]);

            return $this->responseRedirectBackSuccess('Berhasil Menambah Lowongan');
        }catch(Throwable $th){
            return $this->responseRedirectBackError($th->getMessage());
        }
    }
}
