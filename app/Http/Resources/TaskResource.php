<?php

namespace App\Http\Resources;

use App\Domain\Task\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property Task $resource
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $task = $this->resource;

        return [
            'id'        => $task->id()->toInt(),
            'name'      => $task->name(),
            'position'  => $task->position(),
            'completed' => $task->completed(),
        ];
    }
}
