<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'client';
    protected $primaryKey = 'id_client';
    protected $fillable = ['nama_client', 'alamat', 'email', 'no_telp', 'karyawan_id'];

    public function contact_person()
    {
        return $this->hasMany(ContactPerson::class, 'client_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function kategori_client()
    {
        return $this->belongsToMany(KategoriClient::class, 'data_kategori_client', 'client_id', 'kategori_client_id');
    }
}
