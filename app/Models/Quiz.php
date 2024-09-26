<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, HasUlids;
    protected $primaryKey = 'ulid';
    protected $fillable = ['nama_quiz', 'deskripsi', 'jumlah_soal', 'durasi', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
