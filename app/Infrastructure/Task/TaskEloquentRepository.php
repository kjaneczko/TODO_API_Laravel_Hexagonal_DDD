<?php
declare(strict_types=1);

namespace App\Infrastructure\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;
use App\Infrastructure\Exception\DatabaseException;
use App\Models\TaskModel;
use Illuminate\Database\QueryException;

class TaskEloquentRepository implements TaskRepository
{
    /**
     * @throws DatabaseException
     */
    public function create(string $name, int $position, bool $completed): Task
    {
        try {
            $model = TaskModel::create([
                'name' => $name,
                'position' => $position,
                'completed' => $completed,
            ]);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToSave($e);
        }

        if (!$model) {
            throw DatabaseException::failedToSave();
        }

        return TaskPersistenceMapper::toDomain($model);
    }

    public function findById(int $id): Task|null
    {
        $model = TaskModel::find($id);

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
}
