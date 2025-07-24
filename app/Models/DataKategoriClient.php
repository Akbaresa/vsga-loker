<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataKategoriClient extends Model
{
    use HasFactory;

    protected $table = 'data_kategori_client';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['client_id', 'kategori_client_id'];

}
