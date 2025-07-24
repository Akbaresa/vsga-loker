<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPekerjaanProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jenis_pekerjaan_project';
    protected $primaryKey = 'id_jenis_pekerjaan_project';
    protected $fillable = ['jenis_pekerjaan_id', 'project_id', 'jumlah_man_power'];

    public function jenis_pekerjaan(){
        return $this->belongsTo(JenisPekerjaan::class, 'jenis_pekerjaan_id', 'id_jenis_pekerjaan');
    }
    public function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id_project');
    }
}
