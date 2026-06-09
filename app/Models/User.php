<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // public function role(){
    //     return $this->belongsTo(Role::class);
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'secondname',
        'lastname',
        'email',
        'password',
        'status',
        'gender',
        'school',
        'school_id',
        'role',
        'class_id',
        'academic_year',
        'login_at',
        'logout_at',
    ];


    public function getTimeSpentAttribute()
    {
        if ($this->login_at && $this->logout_at) {
            $loginAt = Carbon::parse($this->login_at);
            $logoutAt = Carbon::parse($this->logout_at);
            return $logoutAt->diffForHumans($loginAt, true);
        }

        return null;
    }

    /**
     * Get the user's full name by combining firstname, secondname, and lastname.
     */
    public function getNameAttribute()
    {
        $nameParts = array_filter([
            $this->firstname,
            $this->secondname,
            $this->lastname
        ]);

        return implode(' ', $nameParts) ?: 'No Name';
    }

public function school()
{
    return $this->belongsTo(School::class, 'school_id');
}

public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id');
}


public function classes()
{
    return $this->belongsToMany(SchoolClass::class,  'teacher_class_subject_pivots', 'user_id', 'class_id')
                ->withPivot('subject_id');
}


public function subjects()
{
    return $this->belongsToMany(Subject::class, 'teacher_class_subject_pivots', 'user_id', 'subject_id')
                ->withPivot('class_id');
}

public function teacherSubjects()
{
    return $this->belongsToMany(Subject::class, 'teacher_class_subject_pivots', 'user_id', 'subject_id')
                ->withPivot('class_id');
}

public function assignments()
{
    return $this->hasManyThrough(Assignment::class, SchoolClass::class, 'user_id', 'class_id');
}

public function promotions()
{
    return $this->hasMany(StudentPromotion::class, 'student_id');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
