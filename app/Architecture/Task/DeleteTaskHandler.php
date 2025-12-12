<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;

readonly class DeleteTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(DeleteTaskCommand $command): bool
    {
        return $this->repository->delete($command->id->toInt());
    }
}
