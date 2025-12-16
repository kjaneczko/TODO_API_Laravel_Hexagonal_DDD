<?php
declare(strict_types=1);

namespace App\Infrastructure\Task;

use App\Architecture\Shared\Query\PageRequest;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Domain\TaskList\TaskListId;
use App\Infrastructure\Exception\DatabaseException;
use App\Models\TaskModel;
use Illuminate\Database\QueryException;

class TaskEloquentRepository implements TaskRepositoryInterface
{
    /**
     * @throws DatabaseException
     */
    public function create(Task $task): Task
    {
        try {
            $attributes = TaskPersistenceMapper::toPersistence($task);
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

    public function findAll(PageRequest $pageRequest): array
    {
        $offset = ($pageRequest->page - 1) * $pageRequest->limit;

        return TaskModel::skip($offset)
            ->take($pageRequest->limit)
            ->orderBy('id')
            ->get()
            ->map(fn ($model) => TaskPersistenceMapper::toDomain($model))
            ->all();
    }

    /**
     * @return Task[]
     */
    public function findByTaskListId(TaskListId $taskListId): array
    {
        return TaskModel::where('task_list_id', $taskListId->toInt())
            ->orderBy('position')
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
