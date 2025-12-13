<?php

namespace App\Infrastructure\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Models\TaskModel;

final class TaskPersistenceMapper
{
    public static function toDomain(TaskModel $model): Task
    {
        return Task::reconstitute(
            new TaskId($model->id),
            $model->name,
            $model->position,
            (bool) $model->completed,
        );
    }

    public static function toPersistence(Task $task): array
    {
        return [
            'id'        => $task->id()->toInt(),   // jeśli id jest generowane w DB, ten klucz można pominąć
            'name'      => $task->name(),
            'position'  => $task->position(),
            'completed' => $task->completed(),
        ];
    }
}
