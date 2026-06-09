<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_class_id'

    ];


    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class);
    }

    public function class()
{
    return $this->belongsTo(SchoolClass::class, 'school_class_id');
}
    public function materials()
    {
        return $this->hasMany(Material::class);
    }



    public function teachers()
{
    return $this->belongsToMany(User::class, 'teacher_class_subject_pivot', 'subject_id', 'teacher_id')
                ->withPivot('school_class_id');
}

public function classes()
{
    return $this->belongsTo(SchoolClass::class, 'school_class_id');
}
  
}
