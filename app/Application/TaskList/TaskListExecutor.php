<?php
declare(strict_types=1);

namespace App\Application\TaskList;

use App\Application\TaskList\Exception\TaskListNotFoundException;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;
use App\Domain\TaskList\TaskList;
use App\Domain\TaskList\TaskListId;

readonly class TaskListExecutor
{
    public function __construct(
        private TaskListRepositoryInterface $repository,
    ) {}

    public function getOrFail(TaskListId $id): TaskList
    {
        $taskList = $this->repository->findById($id);

        if (!$taskList) {
            throw TaskListNotFoundException::withId($id);
        }

        return $taskList;
    }

    public function updateOrFail(TaskList $task): void
    {
        if (!$this->repository->update($task)) {
            throw TaskListNotFoundException::withId($task->id());
        }
    }

    public function deleteOrFail(TaskListId $id): void
    {
        if (!$this->repository->delete($id)) {
            throw TaskListNotFoundException::withId($id);
        }
    }
}
