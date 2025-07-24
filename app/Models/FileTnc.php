<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileTnc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_tnc';
    protected $primaryKey = 'id_file_tnc';
    protected $guarded = ['id_file_tnc'];

    public function tnc()
    {
        return $this->belongsTo(Tnc::class, 'tnc_id', 'id_tnc');
    }
}
