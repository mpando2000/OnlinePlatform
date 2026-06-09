<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

   
 

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_class_subject_pivot');
    }

    public function adminSubjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_class_subject_pivots', 'class_id', 'subject_id')
                    ->withPivot('user_id'); // If you want to access the user_id in the pivot table
    }

    public function students()
{
    return $this->hasMany(User::class, 'class_id')->where('role', 'student');
}


    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'class_id');
    }
    

}

