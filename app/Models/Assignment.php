<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id', 
        'title', 
        'description', 
        'file_path',
        'submission_deadline'
    ];

    protected $dates = [
        'submission_deadline',
    ];

    protected $casts = [
        'submission_deadline' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
