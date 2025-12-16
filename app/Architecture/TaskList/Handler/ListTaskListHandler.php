<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Handler;

use App\Architecture\TaskList\Command\ListTaskListCommand;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;
use App\Domain\TaskList\TaskList;

readonly class ListTaskListHandler
{
    public function __construct(
        private TaskListRepositoryInterface $repository,
    ) {}

    /**
     * @return TaskList[]
     */
    public function __invoke(ListTaskListCommand $command): array
    {
        return $this->repository->findAll($command->pageRequest);
    }
}
