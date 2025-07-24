<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_project';
    protected $primaryKey = 'id_file_project';
    protected $guarded = ['id_file_project'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id_project');
    }
}
