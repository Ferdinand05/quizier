<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user,
            'quiz_id' => $this->quiz_id,
            'quiz' => $this->quiz,
            'option_id' => $this->option_id,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
