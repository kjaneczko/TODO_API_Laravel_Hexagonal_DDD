<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\RenameTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class RenameTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ){}

    public function __invoke(RenameTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->rename($command->name);

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }
}
