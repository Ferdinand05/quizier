<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ulid' => $this->ulid,
            'nama_quiz' => $this->nama_quiz,
            'deskripsi' => $this->deskripsi,
            'jumlah_soal' => $this->jumlah_soal,
            'durasi' => $this->durasi,
            'category' => $this->category->nama_kategori,
        ];
    }
}
