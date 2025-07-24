<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPerson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contact_person';
    protected $primaryKey = 'id_contact_person';
    protected $fillable = ['nama_contact_person', 'email', 'no_telp_wa', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function project()
    {
        return $this->belongsToMany(Project::class, 'contact_person_project', 'contact_person_id', 'project_id')
            ->withTimestamps();
    }
    public function contact_person_project()
{
    return $this->hasMany(ContactPersonProject::class, 'contact_person_id', 'id_contact_person');
}
}
