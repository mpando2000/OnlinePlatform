<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class ToDoList extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'task', 'completed', 'due_date'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'due_date' => 'datetime',
    ];
    
}
