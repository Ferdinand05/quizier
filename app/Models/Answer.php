<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'question_id', 'option_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'ulid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
