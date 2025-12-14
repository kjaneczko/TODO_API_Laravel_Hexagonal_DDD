<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\ListTaskCommand;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;

readonly class ListTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    /**
     * @return Task[]
     */
    public function __invoke(ListTaskCommand $command): array
    {
        return $this->repository->findAll($command->pageRequest);
    }
}
