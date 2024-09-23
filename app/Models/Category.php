<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'slug'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'category_id', 'id');
    }
}
