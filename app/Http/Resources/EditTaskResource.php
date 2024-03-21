<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditTaskResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'is_completed' => $this->is_completed,
            'priority' => $this->priority,
            'due_date' => $this->due_date->format('Y-m-d\TH:i'),
        ];
    }

    public static $wrap = null;
}
