<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_item';
    protected $primaryKey = 'id_kategori_item';
    protected $guarded = ['id_kategori_item'];

    
    public function item_tnc(){
        return $this->hasMany(ItemTnc::class, 'id_item_tnc');
    }
}
