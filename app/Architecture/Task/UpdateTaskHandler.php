<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class UpdateTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(UpdateTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id->toInt());
        if (!$task) {
            throw TaskNotFoundException::withId($command->id->toInt());
        }

        $task->rename($command->name);
        $command->completed ? $task->complete() : $task->reopen();
        $task->moveToPosition($command->position);

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id()->toInt());
        }
    }
}
