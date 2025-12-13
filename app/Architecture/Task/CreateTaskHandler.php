<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;

readonly class CreateTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(CreateTaskCommand $command): Task
    {
        return $this->repository->create(
            $command->name,
            $command->position,
            $command->completed,
        );
    }
}
