<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileProgressProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_progress_project';
    protected $primaryKey = 'id_file_progress_project';
    protected $fillable = ['nama_file_progress_project', 'link', 'progress_project_id'];

    public function progress_project()
    {
        return $this->belongsTo(ProgressProject::class, 'progress_project_id', 'id_progress_project');
    }
}
