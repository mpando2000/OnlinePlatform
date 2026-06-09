<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassSubjectPivot extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'school_class_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

   
}
