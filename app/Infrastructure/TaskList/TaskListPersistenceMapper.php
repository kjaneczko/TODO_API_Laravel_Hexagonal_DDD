<?php
declare(strict_types=1);

namespace App\Infrastructure\TaskList;

use App\Domain\TaskList\TaskList;
use App\Domain\TaskList\TaskListId;
use App\Models\TaskListModel;

final class TaskListPersistenceMapper
{
    public static function toDomain(TaskListModel $model): TaskList
    {
        return TaskList::reconstitute(
            new TaskListId($model->id),
            $model->name,
        );
    }

    public static function toPersistence(TaskList $taskList): array
    {
        return [
            'name' => $taskList->name(),
        ];
    }
}
