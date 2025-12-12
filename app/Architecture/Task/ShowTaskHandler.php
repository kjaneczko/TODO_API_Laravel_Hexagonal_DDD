<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;

readonly class ShowTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    public function __invoke(ShowTaskCommand $command): Task|null
    {
        return $this->repository->findById($command->id->toInt());
    }
}
