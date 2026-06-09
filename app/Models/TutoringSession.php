<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutoringSession extends Model
{
    use HasFactory;

     protected $fillable = [
        'teacher_id',
        'session_code',
        'meeting_link'
     ];

     public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
     }
}
