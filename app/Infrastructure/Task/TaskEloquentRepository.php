<?php
declare(strict_types=1);

namespace App\Infrastructure\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Domain\Task\TaskRepository;
use App\Infrastructure\Exception\DatabaseException;
use App\Models\TaskModel;
use Illuminate\Database\QueryException;

class TaskEloquentRepository implements TaskRepository
{
    /**
     * @throws DatabaseException
     */
    public function create(Task $task): Task
    {
        try {
            $model = TaskModel::create([
                'value' => $task->value(),
            ]);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToSave($e);
        }

        if (!$model) {
            throw DatabaseException::failedToSave();
        }

        $task->setId(new TaskId($model->id));

        return $task;
    }

    public function findById(int $id): Task|null
    {
        $model = TaskModel::find($id);

        if (!$model) {
            return null;
        }

        return Task::fromState(
            id: new TaskId($model->id),
            value: $model->value,
        );
    }

    public function findAll(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return TaskModel::skip($offset)
            ->take($limit)
            ->orderBy('id')
            ->get()
            ->map(
                fn ($model) => Task::fromState(
                    id: new TaskId($model->id),
                    value: $model->value,
                )
            )
            ->all();
    }

    /**
     * @throws DatabaseException
     */
    public function update(Task $task): bool
    {
        try {
            $result = (bool)TaskModel::whereKey($task->id()->toInt())->update([
                'value' => $task->value(),
            ]);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToUpdate($e);
        }

        return $result;
    }

    /**
     * @throws DatabaseException
     */
    public function delete(int $id): bool
    {
        try {
            $result = (bool)TaskModel::whereKey($id)->delete();
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToDelete($e);
        }

        return $result;
    }

    private function mapToDomain(TaskModel $task): Task
    {

    }
}
