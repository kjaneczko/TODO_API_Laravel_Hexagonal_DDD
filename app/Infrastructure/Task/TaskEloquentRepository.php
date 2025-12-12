<?php
declare(strict_types=1);

namespace App\Infrastructure\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Domain\Task\TaskRepository;
use App\Models\TaskModel;

class TaskEloquentRepository implements TaskRepository
{
    public function create(Task $task): Task
    {
        $model = new TaskModel();
        $model->value = $task->value();
        $model->save();

        $task->setId(new TaskId($model->id));

        return $task;
    }

    public function findById(int $id): Task|null
    {
        $model = TaskModel::find($id);

        return Task::fromState(
            id: new TaskId($model->id),
            value: $model->value,
        );
    }

    public function findAll(): array
    {
        $models = TaskModel::all();

        return $models->map(
            fn ($model) => Task::fromState(
                id: new TaskId($model->id),
                value: $model->value,
            )
        )->all();
    }

    public function update(Task $task): bool
    {
        $model = TaskModel::find($task->id()->toInt());
        $model->value = $task->value();
        return $model->save();
    }

    public function delete(int $id): bool
    {
        $model = TaskModel::find($id);
        return $model->delete();
    }
}
