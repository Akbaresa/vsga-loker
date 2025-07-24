<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTnc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'detail_tnc';
    protected $primaryKey = 'id_detail_tnc';
    protected $guarded = ['id_detail_tnc'];

    public function tnc(){
        return $this->belongsTo(Tnc::class, 'id_tnc', 'tnc_id');
    }
    public function item_tnc(){
        return $this->belongsTo(ItemTnc::class, 'item_tnc_id', 'id_item_tnc');
    }
}
