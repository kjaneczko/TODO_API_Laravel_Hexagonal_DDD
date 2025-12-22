<?php
declare(strict_types=1);

namespace App\Application\Task;

use App\Application\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;
use App\Domain\Task\TaskId;

readonly class TaskExecutor
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    public function getOrFail(TaskId $id): Task
    {
        $task = $this->repository->findById($id);

        if (!$task) {
            throw TaskNotFoundException::withId($id);
        }

        return $task;
    }

    public function updateOrFail(Task $task): void
    {
        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }

    public function deleteOrFail(TaskId $id): void
    {
        if (!$this->repository->delete($id)) {
            throw TaskNotFoundException::withId($id);
        }
    }
}
