<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quiz_id' => $this->quiz_id,
            'pertanyaan' => $this->pertanyaan,
            'points' => $this->points,
            'quiz' => [
                'ulid' => $this->quiz->ulid,
                'nama_quiz' => $this->quiz->nama_quiz,
                'category_id' => $this->quiz->category_id,
                'kategori' => $this->quiz->category->nama_kategori
            ],
            'options' => collect($this->options)->map(function ($item) {

                return [
                    'id' => $item->id,
                    'question_id' => $item->question_id,
                    'jawaban' => $item->jawaban,
                    'is_correct' => $item->is_correct == 1 ? true : false
                ];
            })
        ];
    }
}
