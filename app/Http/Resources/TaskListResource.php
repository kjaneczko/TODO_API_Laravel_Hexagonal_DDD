<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Domain\TaskList\TaskList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @property TaskList $resource
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $taskList = $this->resource;

        return [
            'id'        => $taskList->id()?->toInt(),
            'name'      => $taskList->name(),
            'tasks'  => $taskList->tasks(),
        ];
    }
}
