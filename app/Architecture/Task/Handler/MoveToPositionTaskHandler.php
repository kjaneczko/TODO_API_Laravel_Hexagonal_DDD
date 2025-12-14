<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\MoveToPositionTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class MoveToPositionTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ){}

    public function __invoke(MoveToPositionTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->moveToPosition($command->position);

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }
}
