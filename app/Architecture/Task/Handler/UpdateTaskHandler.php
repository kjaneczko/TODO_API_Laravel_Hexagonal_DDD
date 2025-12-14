<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\UpdateTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class UpdateTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(UpdateTaskCommand $command): void
    {
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->rename($command->name);
        $command->completed ? $task->complete() : $task->reopen();
        $task->moveToPosition($command->position);

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id());
        }
    }
}
