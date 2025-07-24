<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project';
    protected $primaryKey = 'id_project';
    protected $fillable = ['nama_project', 'deskripsi', 'kebutuhan', 'hc_store', 'perkiraan_revenue', 'jumlah_man_power', 'project_creator_id', 'client_id', 'konsep_kerjasama_id'];

    public function creator()
    {
        return $this->belongsTo(Karyawan::class, 'project_creator_id', 'id_karyawan');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id_client');
    }
    public function contact_person()
    {
        return $this->belongsToMany(ContactPerson::class, 'contact_person_project', 'project_id', 'contact_person_id')
            ->withTimestamps();
    }

    public function konsep_kerjasama()
    {
        return $this->belongsTo(KonsepKerjasama::class, 'konsep_kerjasama_id', 'id_konsep_kerjasama');
    }

    public function anggota()
    {
        return $this->hasMany(AnggotaProject::class, 'project_id');
    }

    public function anggota_project()
    {
        return $this->belongsToMany(Karyawan::class, 'anggota_project', 'project_id', 'karyawan_id');
    }
    public function jenis_pekerjaan()
    {
        return $this->belongsToMany(JenisPekerjaan::class, 'jenis_pekerjaan_project', 'project_id', 'jenis_pekerjaan_id');
    }
    public function progress_project()
    {
        return $this->hasMany(ProgressProject::class, 'project_id', 'id_project');
    }
    public function file_project()
    {
        return $this->hasMany(FileProject::class, 'project_id', 'id_project');
    }
}
