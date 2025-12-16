<?php
declare(strict_types=1);

namespace App\Infrastructure\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Domain\TaskList\TaskListId;
use App\Models\TaskModel;

final class TaskPersistenceMapper
{
    public static function toDomain(TaskModel $model): Task
    {
        return Task::reconstitute(
            new TaskId($model->id),
            $model->name,
            new TaskListId($model->task_list_id),
            $model->position,
            (bool) $model->completed,
        );
    }

    public static function toPersistence(Task $task): array
    {
        return [
            'name' => $task->name(),
            'task_list_id' => $task->taskListId()->toInt(),
            'position' => $task->position(),
            'completed' => $task->completed(),
        ];
    }
}
