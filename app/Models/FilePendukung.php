<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilePendukung extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_pendukung';
    protected $primaryKey = 'id_file_pendukung';
    protected $guarded = ['id_file_pendukung'];
}
