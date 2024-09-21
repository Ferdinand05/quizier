<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'skor'];

    public function userResult()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quizResult()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }
}
