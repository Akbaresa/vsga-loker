<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            return datatables()->of(Lowongan::all())
                ->addIndexColumn()
                ->make(true);
        }

        return view('karyawan.lowongan.index');
    }

    public function store(Request $request){

        $data = Validator::make($request->all(),[
            'name' => 'required',
            'posisi' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'kualifikasi' => 'required',
            'tanggal' => 'required',
            'kontak' => 'required',
        ]);

        if ($data->fails()){
            return $this->reponseError($data->errors()->first());
        }

        $validatedData = $data->validated();

        DB::beginTransaction();
        try {
            Lowongan::create($validatedData);

            DB::commit();
            return $this->reponseSuccess('Berhasil Menambah Lowongan');
        }catch(Exception $e){
            dd($e);
            DB::rollback();
            return $this->reponseError($e->getMessage());
        }
    }

    public function show($clientId)
    {
        if (!$this->isAuthorized($clientId)) {
            abort(403);
        }

        if (!$clientId) {
            abort(404);
        }

        $client = Client::with('kategori_client')->where('id_client', $clientId)->first();
        $clientCollection = collect([$client])->map(function($data) {
            $data->kategoriIds = $data->kategori_client->pluck('id_kategori_client')->toArray();
            return $data;
        });

        $client = $clientCollection->first();
        $kategori = KategoriClient::all();

        if (!$client) {
            abort(404);
        }

        return view('karyawan.client.details', compact('client', 'kategori'));
    }

    public function update(Request $request){
        $data = Validator::make($request->all(),[
            'id_client' => 'required|exists:client,id_client',
            'nama_client' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'kategori' => 'nullable',
        ]);

        if ($data->fails()) {
            return $this->reponseError($data->errors()->first());
        }

        $validatedData = $data->validated();
        if (!$this->isAuthorized($validatedData['id_client'])) {
            return $this->reponseError('Unauthorized!');
        }
        DB::beginTransaction();
        try {
            $client = Client::findOrFail($validatedData['id_client']);

            $client->update([
                'nama_client' => $validatedData['nama_client'],
                'alamat' => $validatedData['alamat'],
                'email' => $validatedData['email'],
                'no_telp' => $validatedData['no_telp'],
            ]);

            if ($validatedData['kategori'] === null) {
                $client->kategori_client()->sync([]);
            } else {
                $client->kategori_client()->sync($validatedData['kategori']);
            }

            DB::commit();
            return $this->reponseSuccess('Berhasil memperbarui data Client');
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            return $this->reponseError($e->getMessage());
        }
    }

    public function delete(Request $request){
        $data = Validator::make($request->all(),[
            'id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Lowongan::where('id_lowongan', $request->id)->delete();

            DB::commit();
            return $this->reponseSuccess('Berhasil Menghapus Client');
        }catch(Exception $e){
            DB::rollback();
            return $this->reponseError($e->getMessage());
        }
    }
}
