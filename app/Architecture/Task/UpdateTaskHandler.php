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
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }

        $task->changename($command->name);

        if (!$this->repository->update($task)) {
            throw TaskNotFoundException::withId($task->id()->toInt());
        }
    }
}
