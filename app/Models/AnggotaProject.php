<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaProject extends Model
{
    use HasFactory;

    protected $table = 'anggota_project';
    protected $primaryKey = 'id_anggota_project';
    protected $fillable = ['project_id', 'karyawan_id', 'add_by'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id_project');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }
}
