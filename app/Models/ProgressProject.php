<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgressProject extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'progress_project';
    protected $primaryKey = 'id_progress_project';
    protected $fillable = ['keterangan', 'pengerjaan', 'tempat_link', 'waktu', 'karyawan_id', 'status_project_id', 'project_id', 'pengerjaan_selanjutnya', 'keterangan_selanjutnya'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id_project');
    }
    public function status_project()
    {
        return $this->belongsTo(StatusProject::class, 'status_project_id', 'id_status_project');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id_karyawan');
    }
    public function file_progress_project()
    {
        return $this->hasMany(FileProgressProject::class, 'progress_project_id', 'id_progress_project');
    }
}
