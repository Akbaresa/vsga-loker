<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPersonProject extends Model
{
    use HasFactory;

    protected $table = 'contact_person_project';
    protected $primaryKey = 'id_contact_person_project';
    protected $fillable = ['contact_person_id', 'project_id'];

    public function contact_person()
    {
        return $this->belongsTo(ContactPerson::class, 'contact_person_id', 'id_contact_person');
    }
}
