<?php
declare(strict_types=1);

namespace App\Application\TaskList\Handler;

use App\Application\TaskList\Command\CreateTaskListCommand;
use App\Domain\TaskList\TaskList;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;

readonly class CreateTaskListHandler
{
    public function __construct(
        private TaskListRepositoryInterface $repository,
    ) {}

    public function __invoke(CreateTaskListCommand $command): TaskList
    {
        return $this->repository->create(
            TaskList::create(
                null,
                $command->name,
            )
        );
    }
}
