<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, HasUlids;
    protected $fillable = ['nama_quiz', 'deskripsi', 'jumlah_soal', 'waktu_mulai', 'waktu_selesai'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
