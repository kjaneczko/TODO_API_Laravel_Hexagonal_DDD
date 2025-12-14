<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\ReopenTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class ReopenTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
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
