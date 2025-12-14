<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\CreateTaskCommand;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;

readonly class CreateTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    public function __invoke(CreateTaskCommand $command): Task
    {
        return $this->repository->create(
            Task::create(
                $command->name,
                $command->position,
                $command->completed,
            )
        );
    }
}
