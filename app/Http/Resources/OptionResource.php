<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'jawaban' => $this->jawaban,
            'is_correct' => $this->is_correct,
            'question_id' => $this->question_id,
            'question' => $this->question
        ];
    }
}
