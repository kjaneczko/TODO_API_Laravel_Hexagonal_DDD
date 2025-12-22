<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\ListTaskCommand;
use App\Application\TaskList\Exception\TaskListNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;

readonly class ListTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
        private TaskListRepositoryInterface $taskListRepository,
    ) {}

    /**
     * @return Task[]
     */
    public function __invoke(ListTaskCommand $command): array
    {
        if ($command->taskListId && !$this->taskListRepository->exists($command->taskListId)) {
            throw new TaskListNotFoundException();
        }

        return $this->repository->findAll($command->pageRequest, $command->taskListId);
    }
}
