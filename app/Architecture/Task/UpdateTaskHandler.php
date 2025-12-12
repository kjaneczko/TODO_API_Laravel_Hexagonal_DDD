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
        if (!$this->repository->update($command->task)) {
            throw TaskNotFoundException::withId($command->task->id()->toInt());
        }
    }
}
