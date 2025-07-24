<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonsepKerjasama extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'konsep_kerjasama';
    protected $primaryKey = 'id_konsep_kerjasama';
    protected $fillable = ['nama_konsep_kerjasama', 'deskripsi'];

    public function project()
    {
        return $this->hasMany(Project::class, 'konsep_kerjasama_id', 'id_konsep_kerjasama');
    }
}
