<?php

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class CompleteTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(CompleteTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id->toInt());

        if (!$task) {
            throw TaskNotFoundException::withId($command->id->toInt());
        }

        $task->complete();
        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id()->toInt());
        }
    }
}
