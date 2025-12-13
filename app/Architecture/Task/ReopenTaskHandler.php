<?php

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class ReopenTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(ReopenTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id);

        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->reopen();

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }
}
