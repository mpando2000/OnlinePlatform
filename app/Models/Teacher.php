<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

  
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject_class')
                    ->withPivot('school_class_id')
                    ->withTimestamps();
    }

}
