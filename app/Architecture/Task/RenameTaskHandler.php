<?php

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class RenameTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
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
