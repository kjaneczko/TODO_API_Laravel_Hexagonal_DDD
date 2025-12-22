<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\CreateTaskCommand;
use App\Application\TaskList\Exception\TaskListNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;

readonly class CreateTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
        private TaskListRepositoryInterface $taskListRepository,
    ) {}

    public function __invoke(CreateTaskCommand $command): Task
    {
        if (!$this->taskListRepository->exists($command->taskListId)) {
            throw new TaskListNotFoundException();
        }

        return $this->repository->create(
            Task::create(
                $command->name,
                $command->taskListId,
                $command->position,
                $command->completed,
            )
        );
    }
}
