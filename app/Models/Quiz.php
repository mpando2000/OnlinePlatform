<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'description', 
        'class_id', 
        'subject_id', 
        'start_time', 
        'end_time', 
        'duration',
        'quiz_file',
    ];

        protected $casts = [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function quiz_results()
    {
        return $this->hasMany(QuizResult::class);
    }

    /**
     * Get the full URL for the quiz file
     */
    public function getQuizFileUrlAttribute()
    {
        if (!$this->quiz_file) {
            return null;
        }
        
        return asset('storage/quizzes/' . $this->quiz_file);
    }

    /**
     * Check if this quiz has a file upload
     */
    public function hasQuizFile()
    {
        return !empty($this->quiz_file);
    }

    /**
     * Get quiz status based on current time
     */
    public function getStatusAttribute()
    {
        $now = now();
        $startTime = $this->start_time;
        $endTime = $this->end_time;
        
        if ($now->lt($startTime)) {
            return 'upcoming';
        } elseif ($now->between($startTime, $endTime)) {
            return 'active';
        } else {
            return 'ended';
        }
    }


}
