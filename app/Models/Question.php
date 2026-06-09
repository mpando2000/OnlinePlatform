<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id', 
        'question_text', 
        'option1', 
        'option2', 
        'option3', 
        'option4', 
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'correct_answer',
        'question_type'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
}
