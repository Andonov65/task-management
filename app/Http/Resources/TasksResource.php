<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
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
            'priority' => str($this->priority)->ucfirst(),
            'due_date' => $this->due_date->format('d/m/Y H:m'),
        ];
    }

    public static $wrap = null;
}
