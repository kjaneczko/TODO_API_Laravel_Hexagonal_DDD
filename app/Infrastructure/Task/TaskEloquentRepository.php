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
            $attributes = TaskPersistenceMapper::toPersistence($task);
            unset($attributes['id']);
            $model = TaskModel::create($attributes);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToSave($e);
        }

        if (!$model) {
            throw DatabaseException::failedToSave();
        }

        return TaskPersistenceMapper::toDomain($model);
    }

    public function findById(TaskId $id): Task|null
    {
        $model = TaskModel::find($id->toInt());

        if (!$model) {
            return null;
        }

        return TaskPersistenceMapper::toDomain($model);
    }

    public function findAll(int $page, int $limit): array
    {
        $offset = ($page - 1) * $limit;

        return TaskModel::skip($offset)
            ->take($limit)
            ->orderBy('id')
            ->get()
            ->map(fn ($model) => TaskPersistenceMapper::toDomain($model))
            ->all();
    }

    /**
     * @throws DatabaseException
     */
    public function update(Task $task): bool
    {
        $attributes = TaskPersistenceMapper::toPersistence($task);
        unset($attributes['id']);

        try {
            $result = (bool)TaskModel::whereKey($task->id()->toInt())->update($attributes);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToUpdate($e);
        }

        return $result;
    }

    /**
     * @throws DatabaseException
     */
    public function delete(TaskId $id): bool
    {
        try {
            $result = (bool)TaskModel::whereKey($id->toInt())->delete();
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToDelete($e);
        }

        return $result;
    }
}
