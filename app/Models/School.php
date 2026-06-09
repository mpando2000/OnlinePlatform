<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'address',
        'phone',
        'email',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'school_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
