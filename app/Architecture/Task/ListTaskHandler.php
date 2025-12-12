<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;

readonly class ListTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    /**
     * @return Task[]
     */
    public function __invoke(ListTaskCommand $command): array
    {
        return $this->repository->findAll($command->page, $command->limit);
    }
}
