<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTnc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'item_tnc';
    protected $primaryKey = 'id_item_tnc';
    protected $guarded = ['id_item_tnc'];

    public function kategori_item(){
        return $this->belongsTo(KategoriItem::class, 'kategori_item_id', 'id_kategori_item');
    }

    public function detail_tnc(){
        return $this->hasMany(DetailTnc::class, 'item_tnc_id', 'id_item_tnc');
    }
    public function detail_tnc_pivot(){
        return $this->hasOne(DetailTnc::class, 'item_tnc_id', 'id_item_tnc');
    }
}
