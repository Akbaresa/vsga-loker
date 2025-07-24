<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status_project';
    protected $primaryKey = 'id_status_project';
    protected $guarded = ['id_status_project'];

    public function project()
    {
        return $this->hasMany(Project::class, 'status_project_id', 'id_status_project');
    }
    public function progress_project()
    {
        return $this->hasMany(ProgressProject::class, 'status_project_id', 'id_status_project');
    }
}
