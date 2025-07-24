<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPekerjaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jenis_pekerjaan';
    protected $primaryKey = 'id_jenis_pekerjaan';
    protected $fillable = ['nama_jenis_pekerjaan', 'deskripsi'];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'jenis_pekerjaan_project', 'jenis_pekerjaan_id', 'project_id');
    }


}
