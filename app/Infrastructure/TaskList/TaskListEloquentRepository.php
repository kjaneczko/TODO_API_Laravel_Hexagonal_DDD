<?php
declare(strict_types=1);

namespace App\Infrastructure\TaskList;

use App\Architecture\Shared\Query\PageRequest;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;
use App\Domain\TaskList\TaskList;
use App\Domain\TaskList\TaskListId;
use App\Infrastructure\Exception\DatabaseException;
use App\Models\TaskListModel;
use Illuminate\Database\QueryException;

class TaskListEloquentRepository implements TaskListRepositoryInterface
{
    /**
     * @throws DatabaseException
     */
    public function create(TaskList $taskList): TaskList
    {
        try {
            $attributes = TaskListPersistenceMapper::toPersistence($taskList);
            $model = TaskListModel::create($attributes);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToSave($e);
        }

        if (!$model) {
            throw DatabaseException::failedToSave();
        }

        return TaskListPersistenceMapper::toDomain($model);
    }

    public function findById(TaskListId $id): TaskList|null
    {
        $model = TaskListModel::find($id->toInt());

        if (!$model) {
            return null;
        }

        return TaskListPersistenceMapper::toDomain($model);
    }

    public function findAll(PageRequest $pageRequest): array
    {
        $offset = ($pageRequest->page - 1) * $pageRequest->limit;

        return TaskListModel::skip($offset)
            ->take($pageRequest->limit)
            ->orderBy('id')
            ->get()
            ->map(fn ($model) => TaskListPersistenceMapper::toDomain($model))
            ->all();
    }

    /**
     * @throws DatabaseException
     */
    public function update(TaskList $taskList): bool
    {
        $attributes = TaskListPersistenceMapper::toPersistence($taskList);

        try {
            $result = (bool)TaskListModel::whereKey($taskList->id()->toInt())->update($attributes);
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToUpdate($e);
        }

        return $result;
    }

    /**
     * @throws DatabaseException
     */
    public function delete(TaskListId $id): bool
    {
        try {
            $result = (bool)TaskListModel::whereKey($id->toInt())->delete();
        }
        catch (QueryException $e) {
            throw DatabaseException::failedToDelete($e);
        }

        return $result;
    }
}
