<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\TaskRepository;

readonly class UpdateTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(UpdateTaskCommand $command): bool
    {
        return $this->repository->update($command->task);
    }
}
