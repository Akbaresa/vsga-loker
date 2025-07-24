<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tnc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tnc';
    protected $primaryKey = 'id_tnc';
    protected $guarded = ['id_tnc'];

    public function jenis_pekerjaan_project(){
        return $this->belongsTo(JenisPekerjaanProject::class, 'jenis_pekerjaan_project_id', 'id_jenis_pekerjaan_project');
    }

    public function anggota_project()
    {
        return $this->hasMany(AnggotaProject::class, 'project_id', 'jenis_pekerjaan_project_id');
    }
    
    public function detail_tnc(){
        return $this->hasMany(DetailTnc::class, 'tnc_id', 'id_tnc');
    }
    public function file_tnc(){
        return $this->hasMany(FileTnc::class, 'tnc_id', 'id_tnc');
    }
}
