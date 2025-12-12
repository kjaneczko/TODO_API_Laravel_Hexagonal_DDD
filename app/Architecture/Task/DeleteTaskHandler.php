<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskRepository;

readonly class DeleteTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(DeleteTaskCommand $command): void
    {
        if (!$this->repository->delete($command->id->toInt())) {
            throw TaskNotFoundException::withId($command->id->toInt());
        }
    }
}
