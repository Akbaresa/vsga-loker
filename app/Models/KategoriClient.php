<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriClient extends Model
{
    use HasFactory;

    protected $table = 'kategori_client';
    protected $primaryKey = 'id_kategori_client';
    protected $fillable = ['nama_kategori_client', 'deskripsi_kategori_client'];

    public function client()
    {
        return $this->belongsToMany(KategoriClient::class, 'data_kategori_client', 'client_id','kategori_client_id');
    }
}
