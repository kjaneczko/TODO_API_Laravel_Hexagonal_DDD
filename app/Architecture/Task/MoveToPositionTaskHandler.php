<?php

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class MoveToPositionTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ){}

    public function __invoke(MoveToPositionTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id->toInt());
        if (!$task) {
            throw TaskNotFoundException::withId($command->id->toInt());
        }

        $task->moveToPosition($command->position);
        $this->repository->update($task);
    }
}
