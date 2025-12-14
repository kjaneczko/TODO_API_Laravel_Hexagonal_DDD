<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\CompleteTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class CompleteTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    public function __invoke(CompleteTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id);

        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->complete();

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }
}
