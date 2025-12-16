<?php

namespace App\Architecture\TaskList\Handler;

use App\Architecture\TaskList\Command\ListTasksInTaskListCommand;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;

readonly class ListTasksInTaskListHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    /**
     * @return Task[]
     */
    public function __invoke(ListTasksInTaskListCommand $command): array
    {
        return $this->repository->findByTaskListId($command->taskListId);
    }
}
