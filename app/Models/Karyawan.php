<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Karyawan extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $guarded = ['id_karyawan'];

    public static function getKaryawan(){
        return Auth::guard('karyawan')->check() ? Auth::guard('karyawan')->user() : Auth::guard('admin')->user();
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'project_creator_id');
    }
    public function anggota_project()
    {
        return $this->belongsToMany(Project::class, 'anggota_project', 'karyawan_id', 'project_id')
            ->withPivot('add_by');
    }
    public function progress_project()
    {
        return $this->hasMany(Project::class, 'karyawan_id', 'id_karyawan');
    }
}
